<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AppareilRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ClientController extends AbstractController
{
    private $session;
    private $appareilRepository;

    public function __construct(AppareilRepository $appareilRepository, SessionInterface $session)
    {
        $this->appareilRepository = $appareilRepository;
        $this->session = $session;
    }

    #[Route('/client', name: 'app_client', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $distinctTypes = $this->appareilRepository->findDistinctTypes();
        $loginName = $this->session->get('user_username');
        $designation = $request->query->get('designation');
        $type = $request->query->get('type'); 
        $prixMin = $request->query->get('prixMin');
        $prixMax = $request->query->get('prixMax');
        $order = $request->query->get('order', 'asc');

        $appareils = [];

        if ($designation) {
            $appareils = $this->appareilRepository->searchByDes($designation);
        } else if($type){
            $appareils = $this->appareilRepository->findByTypeAndPrice($type, $prixMin, $prixMax, $order);
        }else{
            $appareils = $this->appareilRepository->findAll();
        }
        
        return $this->render('client/index.html.twig', [
            'appareils' => $appareils,
            'loginName' => $loginName,
            'types' => $distinctTypes,
            'filters' => [
                'type' => $type,
                'prixMin' => $prixMin,
                'prixMax' => $prixMax,
                'order' => $order,
            ],
        ]);
    }


    #[Route('/client/sort-by-price', name: 'sort_by_price')]
    public function sortByPrice(Request $request): Response
    {
        $order = $request->query->get('order', 'asc');
        $appareils = $this->appareilRepository->findByTypeAndPrice(null, null, null, $order); 
        $loginName = $this->session->get('user_username');

        return $this->render('client/index.html.twig', [
            'appareils' => $appareils,
            'loginName' => $loginName,
        ]);
    }
}

