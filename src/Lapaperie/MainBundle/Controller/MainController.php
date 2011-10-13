<?php

namespace Lapaperie\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{

    public function indexAction()
    {
        return $this->renderLaPaperiePage('LapaperieMainBundle_homepage_paperie');
    }

    public function paperieAction($_route)
    {
        return $this->renderLaPaperiePage($_route);
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
        $active_actions = $repository->findAllNotPreviousYear();
        $archives = $repository->findArchivesOrderByYearDesc();

        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Main:diffusion-infusion.html.twig',
            array(
                'diffusions' => $active_actions,
                'page' => $page,
                'archives' => $archives,
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

    public function projetsAction($year = null)
    {

        $repository = $this->getDoctrine()->getRepository('LapaperieCompaniesBundle:Companie');

        $archives = $repository->findAllYear();

        if($year == null)
        {
            $year = date('Y');
        }

        $companies = $repository->findAllByYearOrderbyDebutResidence($year);

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

        $companies = $repository->findAllByYearOrderbyDebutResidence($companie->getYear());

        return $this->render('LapaperieMainBundle:Soutien:projet.html.twig', array('companies' => $companies, 'companie' => $companie));
    }

    public function culturelleAction($_route)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle');
        $active_actions = $repository->findAllNotPreviousYear();
        $archives = $repository->findArchivesOrderByYearDesc();

        $repository = $this->getDoctrine()->getRepository('LapaperiePagesBundle:Page');
        $page = $repository->findOneBylinkWithRouting(
            $_route
        );

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('LapaperieMainBundle:Main:action-culturelle.html.twig',
            array(
                'actionsculturelles' => $active_actions,
                'page' => $page,
                'archives' => $archives,
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
