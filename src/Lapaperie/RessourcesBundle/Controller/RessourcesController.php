<?php

namespace Lapaperie\RessourcesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Ressources controller.
 *
 * @Route("/ressources-projets")
 */
class RessourcesController extends Controller
{
    /**
     * @Route("/projet/{slug}", name="ressources_detail")
     * @Template()
     */
    public function indexAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieRessourcesBundle:Ressources');
        $active_actions = $repository->findAllNotPreviousYear();
        $archives = $repository->findArchivesOrderByYearDesc();
        $action = $repository->findOneBySlug($slug);

        if (!$action) {
            throw $this->createNotFoundException('Unable to find Ressources entity.');
        }

        //si pas d'appel explicite à getImages, twig ne les voit pas !?
        $action->getGallery()->getImages();

        return $this->render('LapaperieRessourcesBundle:Default:index.html.twig',
            array('ressource' => $action,
                  'actionsculturelles' => $active_actions,
                  'archives' => $archives,
        ));
    }

    /**
     * @Route("/annee/{year}", name="ressources_byyear")
     * @Template()
     */
    public function byYearAction($year)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieRessourcesBundle:Ressources');

        //pour le menu
        $active_actions = $repository->findAllNotPreviousYear();

        //Projets affichés
        $all_by_year = $repository->findByYear($year);

        return $this->render('LapaperieRessourcesBundle:Default:year.html.twig',
            array('actionsbyyear' => $all_by_year,
                'actionsculturelles' => $active_actions,
                'year'     => $year,

        ));
    }

    /**
     * @Route("/archives", name="ressources_archives")
     * @Template()
     */
    public function archivesAction()
    {

        $repository = $this->getDoctrine()->getRepository('LapaperieRessourcesBundle:Ressources');
        $entities = $repository->findArchivesOrderByYearDesc();

        //pour le menu
        $active_actions = $repository->findAllNotPreviousYear();

        return $this->render('LapaperieRessourcesBundle:Default:archives.html.twig',
            array('entities' => $entities,
                  'actionsculturelles' => $active_actions,
                  'archives' => $entities,
        ));
    }
}
