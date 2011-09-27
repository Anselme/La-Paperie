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

        $repository_agenda = $this->getDoctrine()->getRepository('LapaperieAgendaBundle:Actualite');
        $agenda = $repository_agenda->findHomeActualite();

        return $this->render('LapaperieMainBundle:Main:index.html.twig', array('focus' => $focus, 'agenda' => $agenda));
    }

    public function paperieAction()
    {
        return $this->render('LapaperieMainBundle:Paperie:paperie.html.twig');
    }

    public function cnarAction()
    {
        return $this->render('LapaperieMainBundle:Paperie:cnar.html.twig');
    }

    public function equipeAction()
    {
        return $this->render('LapaperieMainBundle:Paperie:equipe.html.twig');
    }

    public function descriptionAction()
    {
        return $this->render('LapaperieMainBundle:Paperie:description.html.twig');
    }

    public function formationAction()
    {
        return $this->render('LapaperieMainBundle:Paperie:formation.html.twig');
    }

    public function diffusionAction()
    {
        return $this->render('LapaperieMainBundle:Main:diffusion-infusion.html.twig');
    }

    public function soutienAction()
    {
        return $this->render('LapaperieMainBundle:Main:soutien-creation.html.twig');
    }

    public function terAction()
    {
        return $this->render('LapaperieMainBundle:Soutien:ter.html.twig');
    }

    public function solliciterAction()
    {
        return $this->render('LapaperieMainBundle:Soutien:solliciter.html.twig');
    }

    public function projetsAction()
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');
        $companies = $repository->findAll();

        return $this->render('LapaperieMainBundle:Soutien:projets.html.twig', array('companies' => $companies));
    }

    public function projetAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');
        $companies = $repository->findAll();
        $companie = $repository->findOneById($id);

        return $this->render('LapaperieMainBundle:Soutien:projet.html.twig', array('companies' => $companies, 'companie' => $companie));
    }

    public function culturelleAction()
    {
        return $this->render('LapaperieMainBundle:Main:action-culturelle.html.twig');
    }
}
