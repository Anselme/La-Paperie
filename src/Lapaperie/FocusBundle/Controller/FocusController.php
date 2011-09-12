<?php

namespace Lapaperie\FocusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FocusController extends Controller
{

    public function indexAction()
    {
        return $this->render('LapaperieFocusBundle:Focus:index.html.twig');
    }
}
