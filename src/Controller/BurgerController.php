<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burgers')]
    public function index(BurgerRepository $burgerRepository):Response{
        $burgers = $burgerRepository->findAll();
        return $this->render('burgers_list.html.twig', ['burgers' => $burgers]);
    }
//    #[Route('/burgers', name: 'burgers')]
//    public function list(): Response
//    {
//        return $this->render('burgers_list.html.twig');
//    }

    #[Route('/burger/{id}', name: 'burger/{id}')]
    public function show(int $id): Response
    {
        //$tab = [0 => ["id" => 1],1 => ["id" => 2], 2 => ["id" => 2]];
        $tab = [0,1,2,3];
        return $this->render('burger_show.html.twig', ['burger' => $tab[$id]]);
    }


}