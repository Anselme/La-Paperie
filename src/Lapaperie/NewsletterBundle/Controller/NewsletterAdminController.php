<?php

namespace Lapaperie\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\NewsletterBundle\Entity\Subscriber;
use Lapaperie\NewsletterBundle\Entity\Inscription;

/**
 * Newsletter Admin controller.
 *
 * @Route("/admin/newsletter")
 */
class NewsletterAdminController extends Controller
{
    /**
     * Lists all Inscription entities.
     *
     * @Route("/", name="newsletter")
     * @Template("LapaperieNewsletterBundle:Admin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieNewsletterBundle:Subscriber')->findAll();

        return array('entities' => $entities);
    }
}
