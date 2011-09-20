<?php

namespace Lapaperie\NewsletterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lapaperie\NewsletterBundle\Entity\Inscription
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\NewsletterBundle\Entity\InscriptionRepository")
 */
class Inscription
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime $date_inscription
     *
     * @ORM\Column(name="date_inscription", type="datetime")
     */
    private $date_inscription;

    /**
     * @var datetime $date_unscribe
     *
     * @ORM\Column(name="date_unscribe", type="datetime", nullable="true")
     */
    private $date_unscribe;

    /**
     * @var string $tokken
     *
     * @ORM\Column(name="tokken", type="string", length=255)
     */
    private $tokken;

    /**
     * @var boolean $confirmation
     *
     * @ORM\Column(name="confirmation", type="boolean")
     */
    private $confirmation;

    /**
     * @ORM\ManyToOne(targetEntity="Subscriber", inversedBy="inscriptions")
     * @ORM\JoinColumn(name="subscriber_id", referencedColumnName="id")
     */
    protected $subscriber;

    function __construct()
    {
        $this->setDateInscription(new \DateTime());
        $this->setTokken("123");
        $this->setConfirmation(false);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date_inscription
     *
     * @param datetime $dateInscription
     */
    public function setDateInscription(\DateTime $dateInscription)
    {
        $this->date_inscription = $dateInscription;
    }

    /**
     * Get date_inscription
     *
     * @return datetime
     */
    public function getDateInscription()
    {
        return $this->date_inscription;
    }

    /**
     * Set date_unscribe
     *
     * @param datetime $dateUnscribe
     */
    public function setDateUnscribe( \DateTime $dateUnscribe = null)
    {
        $this->date_unscribe = $dateUnscribe;
    }

    /**
     * Get date_unscribe
     *
     * @return datetime
     */
    public function getDateUnscribe()
    {
        return $this->date_unscribe;
    }

    /**
     * Set tokken
     *
     * @param string $tokken
     */
    public function setTokken($tokken)
    {
        $this->tokken = $tokken;
    }

    /**
     * Get tokken
     *
     * @return string
     */
    public function getTokken()
    {
        return $this->tokken;
    }

    /**
     * Set confirmation
     *
     * @param boolean $confirmation
     */
    public function setConfirmation($confirmation = false)
    {
        $this->confirmation = $confirmation;
    }

    /**
     * Get confirmation
     *
     * @return boolean
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * Set subscriber
     *
     * @param Lapaperie\NewsletterBundle\Entity\Subscriber $subscriber
     */
    public function setSubscriber(\Lapaperie\NewsletterBundle\Entity\Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Get subscriber
     *
     * @return Lapaperie\NewsletterBundle\Entity\Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }
}
