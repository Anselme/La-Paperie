<?php

namespace Lapaperie\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AgendaController extends Controller
{

    public function indexAction()
    {
        return $this->render('LapaperieAgendaBundle:Default:index.html.twig');
    }
}
