<?php

namespace Lapaperie\ActionCulturelleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * ActionCulturelle controller.
 *
 * @Route("/action-culturelle-projets")
 */
class ActionCulturelleController extends Controller
{
    /**
     * @Route("/projet/{slug}", name="actionculturelle_detail")
     * @Template()
     */
    public function indexAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle');
        $active_actions = $repository->findAllNotPreviousYear();
        $archives = $repository->findArchivesOrderByYearDesc();
        $action = $repository->findOneBySlug($slug);

        if (!$action) {
            throw $this->createNotFoundException('Unable to find ActionCulturelle entity.');
        }

        //si pas d'appel explicite à getImages, twig ne les voit pas !?
        $action->getGallery()->getImages();
        $action->getDirectory()->getFileUpload();

        return $this->render('LapaperieActionCulturelleBundle:Default:index.html.twig',
            array('action' => $action,
                  'actionsculturelles' => $active_actions,
                  'archives' => $archives,
        ));
    }

    /**
     * @Route("/annee/{year}", name="actionculturelle_byyear")
     * @Template()
     */
    public function byYearAction($year)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle');

        //pour le menu
        $active_actions = $repository->findAllNotPreviousYear();

        //Projets affichés
        $all_by_year = $repository->findByYear($year);

        return $this->render('LapaperieActionCulturelleBundle:Default:year.html.twig',
            array('actionsbyyear' => $all_by_year,
                'actionsculturelles' => $active_actions,
                'year'     => $year,

        ));
    }

    /**
     * @Route("/archives", name="actionculturelle_archives")
     * @Template()
     */
    public function archivesAction()
    {

        $repository = $this->getDoctrine()->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle');
        $entities = $repository->findArchivesOrderByYearDesc();

        //pour le menu
        $active_actions = $repository->findAllNotPreviousYear();

        return $this->render('LapaperieActionCulturelleBundle:Default:archives.html.twig',
            array('entities' => $entities,
                  'actionsculturelles' => $active_actions,
                  'archives' => $entities,
        ));
    }
}
