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
}
