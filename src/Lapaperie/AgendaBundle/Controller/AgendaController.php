<?php

namespace Lapaperie\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Agenda controller.
 *
 * @Route("/agenda")
 */
class AgendaController extends Controller
{

    /**
     * Agenda .
     *
     * @Route("/", name="LapaperieAgendaBundle_home")
     */
    public function indexAction()
    {
        return $this->render('LapaperieAgendaBundle:Default:index.html.twig');
    }
}
