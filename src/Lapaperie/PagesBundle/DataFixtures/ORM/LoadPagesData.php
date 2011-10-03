<?php

namespace Lapaperie\PagesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Lapaperie\PagesBundle\Entity\Page;


class LoadPagesData implements FixtureInterface
{
    public function load($manager)
    {

        $lorem_short = <<<LOREM_SHORT
<iframe src="http://player.vimeo.com/video/29606589?title=0&amp;byline=0&amp;portrait=0" width="396" height="317" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
LOREM_SHORT;

        $lorem = <<<LOREM
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis ligula ut nibh blandit ac faucibus ipsum euismod. Nulla facilisi.
Donec pharetra ipsum ac tortor vehicula vitae ultricies dolor pellentesque. Aenean vel est leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer viverra sodales eros, eu gravida arcu sollicitudin eget.
Sed malesuada felis in dui fermentum non vulputate ante scelerisque. Aenean imperdiet ultricies urna, ac vulputate dui pellentesque ut. Praesent nec ipsum velit. Nulla facilisi. Sed vitae nibh diam, at consectetur lectus.
LOREM;


        $pages1 = new Page();
        $pages1->setTitle('La Paperie');
        $pages1->setContenu($lorem);
        $pages1->setVideo($lorem_short);
        $pages1->setLinkWithRouting('LapaperieMainBundle_homepage_paperie');

        $pages2 = new Page();
        $pages2->setTitle('C.N.A.R.');
        $pages2->setContenu($lorem);
        $pages2->setVideo($lorem_short);
        $pages2->setLinkWithRouting('LapaperieMainBundle_homepage_cnar');

        $pages3 = new Page();
        $pages3->setTitle('Centre Ressources/Formation');
        $pages3->setContenu($lorem);
        $pages3->setVideo($lorem_short);
        $pages3->setLinkWithRouting('LapaperieMainBundle_homepage_formation');

        $pages4 = new Page();
        $pages4->setTitle('Fiche Technique du lieu');
        $pages4->setContenu($lorem);
        $pages4->setVideo($lorem_short);
        $pages4->setLinkWithRouting('LapaperieMainBundle_homepage_description');

        $pages5 = new Page();
        $pages5->setTitle('Équipe/Partenaires');
        $pages5->setContenu($lorem);
        $pages5->setVideo($lorem_short);
        $pages5->setLinkWithRouting('LapaperieMainBundle_homepage_partners');

        $pages6 = new Page();
        $pages6->setTitle('Soutien à la Création');
        $pages6->setContenu($lorem);
        $pages6->setVideo($lorem_short);
        $pages6->setLinkWithRouting('LapaperieMainBundle_soutiencreation');

        $pages7 = new Page();
        $pages7->setTitle('T.E.R.');
        $pages7->setContenu($lorem);
        $pages7->setVideo($lorem_short);
        $pages7->setLinkWithRouting('LapaperieMainBundle_soutiencreation_ter');

        $pages8 = new Page();
        $pages8->setTitle('Solliciter une résidence');
        $pages8->setContenu($lorem);
        $pages8->setVideo($lorem_short);
        $pages8->setLinkWithRouting('LapaperieMainBundle_soutiencreation_solliciter');

        $pages9 = new Page();
        $pages9->setTitle('Action culturelle');
        $pages9->setContenu($lorem);
        $pages9->setVideo($lorem_short);
        $pages9->setLinkWithRouting('LapaperieMainBundle_actionculturelle');

        $pages10 = new Page();
        $pages10->setTitle('Diffusion - Infusion');
        $pages10->setContenu($lorem);
        $pages10->setVideo($lorem_short);
        $pages10->setLinkWithRouting('LapaperieMainBundle_diffusioninfusion');

        /*
        $pages11 = new Page();
        $pages11->setTitle('');
        $pages11->setContenu($lorem);
        $pages11->setVideo($lorem_short);
        $pages11->setLinkWithRouting('');
         */

        $manager->persist($pages1);
        $manager->persist($pages2);
        $manager->persist($pages3);
        $manager->persist($pages4);
        $manager->persist($pages5);
        $manager->persist($pages6);
        $manager->persist($pages7);
        $manager->persist($pages8);
        $manager->persist($pages9);
        $manager->persist($pages10);
        //$manager->persist($pages11);

        $manager->flush();
    }
}
