<?php

namespace Lapaperie\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{

    public function indexAction()
    {
        return $this->render('LapaperieAdminBundle::layoutAdmin.html.twig');
    }
}
