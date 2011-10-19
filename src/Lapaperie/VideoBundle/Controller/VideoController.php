<?php

namespace Lapaperie\VideoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Video controller.
 *
 * @Route("/videos")
 */
class VideoController extends Controller
{

    /**
     * Show Videos
     *
     * @Route("/", name="LapaperieVideoBundle_home")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('LapaperieVideoBundle:Video');
        $videos = $repository->findAllOrderByRandom();

        return $this->render('LapaperieVideoBundle:Default:index.html.twig', array('videos' => $videos));
    }
}
