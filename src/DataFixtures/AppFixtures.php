<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $burger = new Burger();
        $burger->setName('Burger 1');
        $burger->setPrice(10);
        $burger->setContent('Tomate, viande');


        // $product = new Product();
        $manager->persist($burger);
        $manager->flush();
    }
}
