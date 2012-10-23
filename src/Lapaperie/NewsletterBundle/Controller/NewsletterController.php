<?php

namespace Lapaperie\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\NewsletterBundle\Entity\Subscriber;
use Lapaperie\NewsletterBundle\Form\SubscriberType;
use Lapaperie\NewsletterBundle\Form\UnSubscriberType;
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

                $this->get('lapaperie_newsletter.create_inscription')->create($subscriber);
                $this->getDoctrine()->getEntityManager()->flush();

                $this->get('session')->setFlash('notice', 'Votre inscription a bien été pris en compte.');

                return $this->render('LapaperieNewsletterBundle:Default:confirmation.html.twig', array('lastname' => $subscriber->getLastname(), 'firstname' => $subscriber->getFirstname(), 'courriel' => $subscriber->getEmail() ));
            }
        }

        return array(
            'entity' => $subscriber,
            'form'   => $form->createView()
        );
    }

    /**
     * Validate The Newsletter Inscription
     *
     * @Route("/validation", name="LapaperieNewsletterBundle_validation_inscription")
     * @Template("LapaperieNewsletterBundle:Default:validation.html.twig")
     */
    public function validateAction(Request $request)
    {
        //$request = $this->getRequest();
        $courriel = $request->query->get('email');
        $token = $request->query->get('token');

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('LapaperieNewsletterBundle:Inscription');
        $inscription = $repository->findOneBytoken($token);

        if(!$inscription)
        {
            throw $this->createNotFoundException('Pas d\'inscription à la Newsletter');
        }

        $subscriber = $inscription->getSubscriber();

        if($subscriber->getEmail() != $courriel )
        {
            throw $this->createNotFoundException('Aucune personne n\'est enregistré sous ce mail.');
        }

        $firstname = $subscriber->getFirstname();
        $lastname = $subscriber->getLastname();

        $inscription->setConfirmation(true);
        $inscription->setDateConfirmation(new \DateTime);
        $em->flush();

        $mail = \Swift_Message::newInstance()
            ->setSubject('Confirmation de votre inscription à la Newsletter de La Paperie')
            ->setFrom($this->container->getParameter('contact_email_from'))
            ->setTo($subscriber->getEmail())
            ->setBody($this->renderView('LapaperieNewsletterBundle:Default:email-confirmation.txt.twig',
                array('firstname' => $firstname,
                'lastname' => $lastname,
                'courriel' => $courriel,
                'token' => $inscription->getToken(),
            )
        ));

        $this->get('mailer')->send($mail);

        return array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'courriel' => $courriel,
        );
    }

    /**
     * Unsubscribe to the newsletter
     *
     * @Route("/desinscription", name="newsletter_unsubscribe")
     * @Template("LapaperieNewsletterBundle:Default:form-unsubscribe.html.twig")
     */
    public function unsubscribeAction()
    {

        $request = $this->getRequest();
        $subscriber = new Subscriber();
        $form = $this->createForm(new UnSubscriberType, $subscriber);

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $postData = $request->request->get('lapaperie_subscriberbundle_unsubscribertype');
                $courriel = $postData['email'];
                $em = $this->getDoctrine()->getEntityManager();
                $repository = $em->getRepository('LapaperieNewsletterBundle:Subscriber');
                $subscriber = $repository->findOneByEmail($courriel);

                if(!$subscriber)
                {
                    throw $this->createNotFoundException('Pas d\'inscrit sous ce courriel à la newsletter... donc pas de désinscription');
                }

                $inscriptions = $subscriber->getInscriptions();

                foreach($inscriptions as $inscription){
                    $inscription->setConfirmation(false);
                    $inscription->setDateUnscribe(new \DateTime);
                    $em->flush();
                }

                return $this->render('LapaperieNewsletterBundle:Default:confirmation-desinscription.html.twig', array('lastname' => $subscriber->getLastname(), 'firstname' => $subscriber->getFirstname(), 'courriel' => $subscriber->getEmail() ));
            }
        }

        return array(
            'form'   => $form->createView(),
        );
    }

}
