<?php

namespace Lapaperie\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{

    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieFocusBundle:Focus');
        $focus = $repository->findOneBy(
            array('isOnLine' => true),
            array('publicationDate' => 'ASC')
        );

        return $this->render('LapaperieMainBundle:Main:index.html.twig', array('focus' => $focus));
        //return $this->render('LapaperieMainBundle:Main:index.html.twig');
    }

    public function diffusionAction()
    {
        return $this->render('LapaperieMainBundle:Main:diffusion-infusion.html.twig');
    }

    public function soutienAction()
    {
        return $this->render('LapaperieMainBundle:Main:soutien-creation.html.twig');
    }

    public function projetsAction()
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');
        $companies = $repository->findAll();

        return $this->render('LapaperieMainBundle:Main:projets.html.twig', array('companies' => $companies));
    }

    public function projetAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');
        $companies = $repository->findAll();
        $companie = $repository->findOneById($id);

        return $this->render('LapaperieMainBundle:Main:projet.html.twig', array('companies' => $companies, 'companie' => $companie));
    }

    public function culturelleAction()
    {
        return $this->render('LapaperieMainBundle:Main:action-culturelle.html.twig');
    }
}
