<?php

namespace Lapaperie\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class VideoController extends Controller
{

    public function indexAction()
    {
        return $this->render('LapaperieVideoBundle:Default:index.html.twig');
    }
}
