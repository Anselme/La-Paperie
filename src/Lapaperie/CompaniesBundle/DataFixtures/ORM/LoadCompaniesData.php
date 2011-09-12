<?php

namespace Lapaperie\CompaniesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Lapaperie\CompaniesBundle\Entity\Companie;


class LoadCompaniesData implements FixtureInterface
{
    public function load($manager)
    {

        $lorem_short = <<<LOREM_SHORT
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis ligula ut nibh blandit ac faucibus ipsum euismod. Nulla facilisi.
LOREM_SHORT;

        $lorem = <<<LOREM
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis ligula ut nibh blandit ac faucibus ipsum euismod. Nulla facilisi.
Donec pharetra ipsum ac tortor vehicula vitae ultricies dolor pellentesque. Aenean vel est leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer viverra sodales eros, eu gravida arcu sollicitudin eget.
Sed malesuada felis in dui fermentum non vulputate ante scelerisque. Aenean imperdiet ultricies urna, ac vulputate dui pellentesque ut. Praesent nec ipsum velit. Nulla facilisi. Sed vitae nibh diam, at consectetur lectus.
LOREM;


        $companie1 = new Companie();
        $companie1->setName('Les Batteurs de Pavés');
        $companie1->setCreation('Macadam Cyrano');
        $companie1->setShortText($lorem_short);
        $companie1->setLongText($lorem);
        $companie1->setDateSortieDeFabrique(new \DateTime());
        $companie1->setDateResidenceEnd(new \DateTime());
        $companie1->setDateResidenceBeginning(new \DateTime());

        $companie2 = new Companie();
        $companie2->setName('La companie Thé à la Rue');
        $companie2->setCreation('A Vendre');
        $companie2->setShortText($lorem_short);
        $companie2->setLongText($lorem);
        $companie2->setDateSortieDeFabrique(new \DateTime());
        $companie2->setDateResidenceEnd(new \DateTime());
        $companie2->setDateResidenceBeginning(new \DateTime());

        $companie3 = new Companie();
        $companie3->setName("Créton'ART");
        $companie3->setCreation('Rêves toujours');
        $companie3->setShortText($lorem_short);
        $companie3->setLongText($lorem);
        $companie3->setDateSortieDeFabrique(new \DateTime());
        $companie3->setDateResidenceEnd(new \DateTime());
        $companie3->setDateResidenceBeginning(new \DateTime());

        $manager->persist($companie1);
        $manager->persist($companie2);
        $manager->persist($companie3);

        $manager->flush();
    }
}
