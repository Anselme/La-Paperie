<?php

namespace Lapaperie\DiffusionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Diffusion controller.
 *
 * @Route("/diffusion-projets")
 */
class DiffusionController extends Controller
{
    /**
     * @Route("/projet/{slug}", name="diffusion_detail")
     * @Template()
     */
    public function indexAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieDiffusionBundle:Diffusion');
        $active_actions = $repository->findAllNotPreviousYear();
        $archives = $repository->findArchivesOrderByYearDesc();
        $action = $repository->findOneBySlug($slug);

        if (!$action) {
            throw $this->createNotFoundException('Unable to find Focus entity.');
        }

        return $this->render('LapaperieDiffusionBundle:Default:index.html.twig',
            array('action' => $action,
                  'diffusions' => $active_actions,
                  'archives' => $archives,
        ));
    }

    /**
     * @Route("/annee/{year}", name="diffusion_byyear")
     * @Template()
     */
    public function byYearAction($year)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieDiffusionBundle:Diffusion');

        //pour le menu
        $active_actions = $repository->findAllNotPreviousYear();

        //Projets affichés
        $all_by_year = $repository->findByYear($year);

        return $this->render('LapaperieDiffusionBundle:Default:year.html.twig',
            array('actionsbyyear' => $all_by_year,
                'diffusions' => $active_actions,
                'year'     => $year,

        ));
    }

    /**
     * @Route("/archives", name="diffusion_archives")
     * @Template()
     */
    public function archivesAction()
    {

        $repository = $this->getDoctrine()->getRepository('LapaperieDiffusionBundle:Diffusion');
        $entities = $repository->findArchivesOrderByYearDesc();

        //pour le menu
        $diffusions = $repository->findAllNotPreviousYear();

        return $this->render('LapaperieDiffusionBundle:Default:archives.html.twig',
            array('entities' => $entities,
                  'diffusions' => $diffusions,
                  'archives' => $entities,
        ));
    }
}
