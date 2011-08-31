<?php

namespace Lapaperie\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{

    public function indexAction()
    {
        return $this->render('LapaperieMainBundle:Main:index.html.twig');
    }

    public function diffusionAction()
    {
        return $this->render('LapaperieMainBundle:Main:diffusion-infusion.html.twig');
    }

    public function soutienAction()
    {
        return $this->render('LapaperieMainBundle:Main:soutien-creation.html.twig');
    }

    public function culturelleAction()
    {
        return $this->render('LapaperieMainBundle:Main:action-culturelle.html.twig');
    }
}
