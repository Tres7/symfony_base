<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Pain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $burger = new Burger();
        for($i=1; $i<10; $i++){
            $burger = new Burger();
            $burger->setName('Burger '.$i);
            $burger->setPrice(25);
            $burger->setContent('Tomate, viande');
            $manager->persist($burger);
        }
        $pain = new Pain();
        for($i=1; $i<10; $i++){
            $poids = 10;
            $poids += $i;
            $pain = new Pain();
            $pain->setType('Pain '.'Standard');
            $pain->setPoids($poids);
            $manager->persist($pain);
        }



        // $product = new Product();
//        $manager->persist($burger);
        $manager->flush();
    }
}
