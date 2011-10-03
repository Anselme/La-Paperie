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
        // a modifier une fois l'histoire du flash tranchée
        return $this->render('LapaperieMainBundle:Paperie:paperie.html.twig');
    }

    public function cnarAction($_route)
    {
        return $this->renderLaPaperiePage($_route);
    }

    public function equipeAction($_route)
    {
        return $this->renderLaPaperiePage($_route);
    }

    public function descriptionAction($_route)
    {
        return $this->renderLaPaperiePage($_route);
    }

    public function formationAction($_route)
    {
        return $this->renderLaPaperiePage($_route);
    }

    public function diffusionAction($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieDiffusionBundle:Diffusion');
        $actions = $repository->findAllYear();
        $active_actions = $repository->findAllNotPreviousYear();

        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Main:diffusion-infusion.html.twig',
            array(
                'archives' => $actions,
                'diffusions' => $active_actions,
                'page' => $page,
        ));
    }

    public function soutienAction($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Main:soutien-creation.html.twig', array('page' => $page));
    }

    public function terAction($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Soutien:ter.html.twig', array('page' => $page));
    }

    public function solliciterAction($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Soutien:solliciter.html.twig', array('page' => $page));
    }

    public function projetsAction($year)
    {

        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');

        $archives = $repository->findAllYear();

        $companies = $repository->findByYear($year);

        return $this->render('LapaperieMainBundle:Soutien:projets.html.twig',
            array('companies' => $companies, 'archives' => $archives, 'year' => $year));
    }

    public function projetAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');
        $companie = $repository->findOneBySlug($slug);

        if (!$companie) {
            throw $this->createNotFoundException('Unable to find Focus entity.');
        }

        $companies = $repository->findAllByYear($companie->getYear());

        return $this->render('LapaperieMainBundle:Soutien:projet.html.twig', array('companies' => $companies, 'companie' => $companie));
    }

    public function culturelleAction($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle');
        $actions = $repository->findAllYear();
        $active_actions = $repository->findAllNotPreviousYear();

        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Main:action-culturelle.html.twig',
            array(
                'archives' => $actions,
                'actionsculturelles' => $active_actions,
                'page' => $page,
        ));
    }

    /**
     * Render la Paperie Pages
     *
     * Can be override in the *Action() function
     *
     */
    public function renderLaPaperiePage($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Paperie:page.html.twig', array('page' => $page));
    }

}
