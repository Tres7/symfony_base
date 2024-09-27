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

    #[Route('/burgers/ingredient/{ingredient}', name: 'burgers_ingredient')]
    public function findBurgersWithIngredient(BurgerRepository $burgerRepository, string $ingredient): Response
    {
        $burgers = $burgerRepository->findBurgersWithIngredient($ingredient);
        return $this->render('burger/burger_finded.html.twig', ['burgers_finded' => $burgers]);
    }
    /** *
     * @param BurgerRepository $burgerRepository
     *user enter a limit of price of his choice and can show the burgers that are less than the price he entered
     */
    #[Route('/burgers/top/{limit}', name: 'burgers_top')]
    public function findTopXburger(BurgerRepository $burgerRepository,int $limit): Response
    {
        $topBurgers = $burgerRepository->findTopXBurgers($limit);
        return $this->render('burger/top_burgers.html.twig', ['top_burgers' => $topBurgers]);

    }


}