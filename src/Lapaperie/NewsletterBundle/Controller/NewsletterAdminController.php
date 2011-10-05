<?php

namespace Lapaperie\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $newsLetterRepository = $this->getDoctrine()->getEntityManager()->getRepository('LapaperieNewsletterBundle:Subscriber');;

        //createQueyrBuilder créé une query findAll() par defaut
        $query = $newsLetterRepository->createQueryBuilder('n');
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(25);
        $paginator->setCurrentPage($this->get('request')->query->get('page', 1), false, true);

        return array('paginator' => $paginator);
    }

    /**
     * Export csv Subscribers
     *
     * @Route("/export", name="newsletter_export")
     * @Template("LapaperieNewsletterBundle:Admin:export.csv.twig")
     */
    public function exportAction(Request $request)
    {

        $all = $request->query->get('all');

        $em = $this->getDoctrine()->getEntityManager();

        $file_name = date('YmdGis')."_newsletter.csv";
        $csv_template = "LapaperieNewsletterBundle:Admin:export.csv.twig" ;

        if($all)
        {
            $file_name = "all_".$file_name ;
            $csv_template = "LapaperieNewsletterBundle:Admin:export-all.csv.twig" ;
            $entities = $em->getRepository('LapaperieNewsletterBundle:Subscriber')->findAll();
        }
        else
        {
            //have a look in Entity/SubscriberRepository.php
            $entities = $em->getRepository('LapaperieNewsletterBundle:Subscriber')->findAllActive();
        }

        $response = $this->render($csv_template, array('entities' => $entities)) ;
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-disposition', 'attachment;filename='.$file_name);

        return $response;
    }
}
