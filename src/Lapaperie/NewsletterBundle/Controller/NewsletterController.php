<?php

namespace Lapaperie\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\NewsletterBundle\Entity\Subscriber;
use Lapaperie\NewsletterBundle\Form\SubscriberType;
use Lapaperie\NewsletterBundle\Entity\Inscription;

/**
 * Newsletter controller.
 *
 * @Route("/newsletter")
 */
class NewsletterController extends Controller
{
    /**
     * @Route("/inscription")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => $name);
    }

    /**
     * Creates a new Subscriber entity
     *
     * @Route("/create", name="newsletter_create")
     * @Template("LapaperieNewsletterBundle:Default:form.html.twig")
     */
    public function createAction()
    {
        $subscriber = new Subscriber();
        $request = $this->getRequest();
        $form = $this->createForm(new SubscriberType, $subscriber);

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $inscription = new Inscription();
                $inscription->setSubscriber($subscriber);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($subscriber);
                $em->persist($inscription);
                $em->flush();

                //

                return $this->redirect($this->generateUrl('newsletter_create' ));
            }
        }

        return array(
            'entity' => $subscriber,
            'form'   => $form->createView()
        );
    }
}
