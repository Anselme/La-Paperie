<?php

namespace Lapaperie\FocusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use lapaperie\FocusBundle\Entity\Focus;


class LoadFocusData implements FixtureInterface
{
    public function load($manager)
    {

        $lorem = <<<LOREM
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis ligula ut nibh blandit ac faucibus ipsum euismod. Nulla facilisi. Donec pharetra ipsum ac tortor vehicula vitae ultricies dolor pellentesque.
Aenean vel est leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer viverra sodales eros, eu gravida arcu sollicitudin eget.

Sed malesuada felis in dui fermentum non vulputate ante scelerisque. Aenean imperdiet ultricies urna, ac vulputate dui pellentesque ut. Praesent nec ipsum velit. Nulla facilisi. Sed vitae nibh diam, at consectetur lectus.
LOREM;

        $vimeo = <<<VIMEO
<iframe src="http://player.vimeo.com/video/26268856?title=0&amp;byline=0&amp;portrait=0" width="400" height="300" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
VIMEO;



        $focus0 = new Focus();
        $focus0->setTitle('Focus');
        $focus0->setText($lorem);
        $focus0->setIsOnline(true);
        $focus0->setPublicationDate(new \DateTime());
        $focus0->setVideo($vimeo);
        $focus0->setLegend('Rictus en résidence du 1er Janvier au 22 Février 2012.');

        $manager->persist($focus0);

        $manager->flush();
    }
}
