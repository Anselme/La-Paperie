<?php

namespace Lapaperie\CompaniesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CompaniesController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('LapaperieCompaniesBundle:Default:index.html.twig');
    }
}
