<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Form\BurgerType;
use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Config\Framework\RequestConfig;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burgers')]
    public function burger_list(BurgerRepository $burgerRepository):Response{
        $burgers = $burgerRepository->findAll();
        return $this->render('burgers_list.html.twig', ['burgers' => $burgers]);
    }
//    #[Route('/burgers', name: 'burgers')]
//    public function list(): Response
//    {
//        return $this->render('burgers_list.html.twig');
//    }
//    }
//
//    #[Route('/burger/{id}', name: 'burger/{id}')]
//    public function show(int $id): Response
//    {
//        //$tab = [0 => ["id" => 1],1 => ["id" => 2], 2 => ["id" => 2]];
//        $tab = [0,1,2,3];
//        return $this->render('burger_show.html.twig', ['burger' => $tab[$id]]);
//    }

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

    #[Route('/burger/{id}/edit', name: 'burger_edit')]
    public function editBurger(Burger $burger, Request $request, EntityManagerInterface $em):Response
    {
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()  )
        {
            $em->flush();
            $this->addFlash('success', 'Burger updated successfully');
            return $this->redirectToRoute('burgers');

        }
        return $this->render('burger/edit_burger.html.twig',['form' => $form, 'burger' => $burger]);

    }

    #[Route('/burger/new', name: 'burger_new')]
    public function addNewBurger(Request $request, EntityManagerInterface $em):Response
    {
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()  )
        {
            $em->persist($burger);
            $em->flush();
            $this->addFlash('success', 'Burger created successfully');
            return $this->redirectToRoute('burgers');

        }
        return $this->render('burger/new_burger.html.twig',['form' => $form]);

    }

    #[Route('/burger/{id}/remove', name: 'burger_remove')]
    public function remove(Burger $burger, EntityManagerInterface $em):Response
    {
        $em->remove($burger);
        $em->flush();
        $this->addFlash('success', 'Burger removed successfully');
        return $this->redirectToRoute('burgers');
    }



}