<?php

namespace Lapaperie\NewsletterBundle;

use Lapaperie\NewsletterBundle\Entity\Subscriber;
use Lapaperie\NewsletterBundle\Entity\Inscription;

class createInscription
{

    protected $entityManager ;

    protected $mailer ;

    protected $email_from ;

    protected $templating ;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager, \Swift_Mailer $mailer, $email_from, \Symfony\Component\Templating\EngineInterface $templating)
    {
        $this->entityManager = $entityManager ;
        $this->mailer = $mailer ;
        $this->email_from = $email_from ;
        $this->templating = $templating ;
    }

    public function create(Subscriber $subscriber)
    {

        //recherche si le subscriber existe déjà
        $repository = $this->entityManager->getRepository('LapaperieNewsletterBundle:Subscriber');
        $subscriber_exists = $repository->findOneByEmail($subscriber->getEmail());
        if($subscriber_exists) {
            $subscriber = $subscriber_exists ;
        }

        //Inscription
        $inscription = new Inscription();
        $inscription->setSubscriber($subscriber);

        $this->entityManager->persist($subscriber);
        $this->entityManager->persist($inscription);

        //Envoi du mail demandant confirmation
        //de l'inscription
        $lastname = $subscriber->getLastname() ;
        $firstname =  $subscriber->getFirstname() ;
        $courriel =  $subscriber->getEmail() ;

        $mail = \Swift_Message::newInstance()
            ->setSubject('Inscription à la Newsletter de La Paperie')
            ->setFrom($this->email_from)
            ->setTo($subscriber->getEmail())
            ->setBody(
                $this->templating->render('LapaperieNewsletterBundle:Default:email-validation.txt.twig',
                array('firstname' => $firstname,
                'lastname' => $lastname,
                'courriel' => $courriel,
                'token' => $inscription->getToken(),
            )
        )
    );

        $this->mailer->send($mail);
    }
}

