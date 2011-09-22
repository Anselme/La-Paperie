<?php

namespace Lapaperie\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

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

        $query = $em->createQuery('SELECT t FROM LapaperieNewsletterBundle:Subscriber t');
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(5);
        $paginator->setCurrentPage($this->get('request')->query->get('page', 1), false, true);

        return array('paginator' => $paginator);
    }

    /**
     * Export csv Subscribers
     *
     * @Route("/export", name="newsletter_export")
     * @Template("LapaperieNewsletterBundle:Admin:export.csv.twig")
     */
    public function exportAction()
    {

        $em = $this->getDoctrine()->getEntityManager();

        //have a look in Entity/SubscriberRepository.php
        $entities = $em->getRepository('LapaperieNewsletterBundle:Subscriber')->findAllActive();

        $file_name = date('YmdGis')."_newsletter.csv";

        $csv = $this->render('LapaperieNewsletterBundle:Admin:export.csv.twig',array('entities' => $entities)) ;
        $response = new Response($csv);
        $response->setContent($csv);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-disposition', 'attachment;filename='.$file_name);

        return $response;
    }
}