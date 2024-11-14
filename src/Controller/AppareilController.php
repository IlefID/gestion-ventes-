<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AppareilRepository;
use App\Entity\Appareil;
use App\Form\AppareilType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FabricantRepository; 


#[Route('/appareil')]
class AppareilController extends AbstractController
{
    private $fabricantRepository;

    public function __construct(FabricantRepository $fabricantRepository)
    {
        $this->fabricantRepository = $fabricantRepository;
    }

    #[Route('/', name: 'app_appareil_index', methods: ['GET'])]
    public function index(Request $request, AppareilRepository $appareilRepository): Response
    {
        $type = $request->query->get('type');
        $nom = $request->query->get('nom');
        
        $appareils = $appareilRepository->searchByName($type, $nom);
        $fabricants = $this->fabricantRepository->findAll(); 

        return $this->render('appareil/index.html.twig', [
            'appareils' => $appareils,
            'fabricants' => $fabricants,
        ]);
    }

    #[Route('/new', name: 'app_appareil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appareil = new Appareil();
        $form = $this->createForm(AppareilType::class, $appareil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appareil);
            $entityManager->flush();

            return $this->redirectToRoute('app_appareil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('appareil/new.html.twig', [
            'appareil' => $appareil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appareil_show', methods: ['GET'])]
    public function show(Appareil $appareil): Response
    {
        return $this->render('appareil/show.html.twig', [
            'appareil' => $appareil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_appareil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Appareil $appareil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AppareilType::class, $appareil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_appareil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('appareil/edit.html.twig', [
            'appareil' => $appareil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appareil_delete', methods: ['POST'])]
    public function delete(Request $request, Appareil $appareil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appareil->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($appareil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_appareil_index', [], Response::HTTP_SEE_OTHER);
    }
}
