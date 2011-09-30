<?php

namespace Lapaperie\ActionCulturelleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * ActionCulturelle controller.
 *
 * @Route("/action-culturelle-projet")
 */
class ActionCulturelleController extends Controller
{
    /**
     * @Route("/{id}", name="actionculturelle_detail")
     * @Template()
     */
    public function indexAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle');
        $actions = $repository->findAllYear();
        $active_actions = $repository->findAllNotPreviousYear();
        $action = $repository->findOneById($id);
        return $this->render('LapaperieActionCulturelleBundle:Default:index.html.twig',
            array('action' => $action,
                'archives' => $actions,
                'actionsculturelles' => $active_actions,

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
        $actions = $repository->findAllYear();
        $active_actions = $repository->findAllNotPreviousYear();

        //Projets affichés
        $all_by_year = $repository->findByYear($year);

        return $this->render('LapaperieActionCulturelleBundle:Default:year.html.twig',
            array('actionsbyyear' => $all_by_year,
                'archives' => $actions,
                'actionsculturelles' => $active_actions,
                'year'     => $year,

        ));
    }
}
