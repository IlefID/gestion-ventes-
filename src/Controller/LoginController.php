<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\User;

class LoginController extends AbstractController
{
    private $entityManager;
    private $session;
    private $doctrine;   

    public function __construct(EntityManagerInterface $entityManager,ManagerRegistry $doctrine, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->doctrine = $doctrine;
    }

    #[Route('/', name: 'login', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        
        $error = false;

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username, 'password' => $password]);

            if ($user) {
                $this->storeUserDataInSession($user);

                if ($user->getRole() === 'admin') {
                    return $this->redirectToRoute('app_admin');
                } elseif ($user->getRole() !== 'user') {
                    return $this->redirectToRoute('app_client');
                }
            } else {
                $error = true;
            }
        }

        return $this->render('login/index.html.twig', [
            'error' => $error,
        ]);
    }

    public function logout(SessionInterface $session): Response
    {
        $session->invalidate();
        return $this->redirectToRoute('login');
    }

    private function storeUserDataInSession(User $user): void
    {
        $this->session->set('user_id', $user->getId());
        $this->session->set('user_username', $user->getUsername());
        $this->session->set('user_role', $user->getRole());
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'form' => $form->createView(),
        ]);
    }
}