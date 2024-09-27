<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oignonTab=['Oignon rouge', 'Oignon blanc', 'Oignon jaune','Oignon caramelisé', 'Oignon frit', 'Oignon cru', 'Oignon cuit', 'Oignon en lamelles', 'Oignon en rondelles', 'Oignon en dés'];
        $sauceTab = ['Ketchup', 'Mayonnaise', 'Moutarde', 'Sauce barbecue', 'Sauce blanche', 'Sauce piquante', 'Sauce tomate', 'Sauce tartare', 'Sauce au poivre', 'Sauce béarnaise'];
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

        foreach ($oignonTab as $oignonName){
            $oignon = new Oignon();
            $oignon->setName($oignonName);
            $oignon->setQuantite(17);
            $manager->persist($oignon);
        }

        foreach ($sauceTab as $sauceName){
            $sauce = new Sauce();
            $sauce->setNom($sauceName);
            $sauce->setQuantite(45);
            $manager->persist($sauce);
        }
//        for($i=1; $i<10; $i++){
//            $oignon = new Oignon();
//            $oignon->setName($oignonTab[$i]);
//            $oignon->setQuantite($i+2);
//            $manager->persist($oignon);
//        }

        // $product = new Product();
//        $manager->persist($burger);
        $manager->flush();
    }
}
