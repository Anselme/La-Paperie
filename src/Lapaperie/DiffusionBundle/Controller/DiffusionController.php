<?php

namespace Lapaperie\DiffusionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Diffusion controller.
 *
 * @Route("/diffusion-projet")
 */
class DiffusionController extends Controller
{
    /**
     * @Route("/{slug}", name="diffusion_detail")
     * @Template()
     */
    public function indexAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieDiffusionBundle:Diffusion');
        $actions = $repository->findAllYear();
        $active_actions = $repository->findAllNotPreviousYear();

        $action = $repository->findOneBySlug($slug);
        return $this->render('LapaperieDiffusionBundle:Default:index.html.twig',
            array('action' => $action,
                'archives' => $actions,
                'diffusions' => $active_actions,

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
        $actions = $repository->findAllYear();
        $active_actions = $repository->findAllNotPreviousYear();

        //Projets affichés
        $all_by_year = $repository->findByYear($year);

        return $this->render('LapaperieDiffusionBundle:Default:year.html.twig',
            array('actionsbyyear' => $all_by_year,
                'archives' => $actions,
                'diffusions' => $active_actions,
                'year'     => $year,

        ));
    }
}
