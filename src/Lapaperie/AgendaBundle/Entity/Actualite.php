<?php

namespace Lapaperie\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\AgendaBundle\Entity\Actualite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\AgendaBundle\Entity\ActualiteRepository")
 */
class Actualite
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
     * @var datetime $date_beginning
     *
     * @ORM\Column(name="date_beginning", type="datetime")
     */
    private $date_beginning;

    /**
     * @var datetime $date_end
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $date_end;

    /**
     * @var text $actualite
     *
     * @ORM\Column(name="actualite", type="text")
     */
    private $actualite;

    /**
     * @var boolean $isOnHome
     *
     * @ORM\Column(name="isOnHome", type="boolean")
     */
    private $isOnHome;


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
     * Set date_beginning
     *
     * @param datetime $dateBeginning
     */
    public function setDateBeginning(\DateTime $dateBeginning)
    {
        $this->date_beginning = $dateBeginning;
    }

    /**
     * Get date_beginning
     *
     * @return datetime
     */
    public function getDateBeginning()
    {
        return $this->date_beginning;
    }

    /**
     * Set date_end
     *
     * @param datetime $dateEnd
     */
    public function setDateEnd( \DateTime $dateEnd)
    {
        $this->date_end = $dateEnd;
    }

    /**
     * Get date_end
     *
     * @return datetime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * Set actualite
     *
     * @param text $actualite
     */
    public function setActualite($actualite)
    {
        $this->actualite = $actualite;
    }

    /**
     * Get actualite
     *
     * @return text
     */
    public function getActualite()
    {
        return $this->actualite;
    }

    /**
     * Set isOnHome
     *
     * @param boolean $isOnHome
     */
    public function setIsOnHome($isOnHome)
    {
        $this->isOnHome = $isOnHome;
    }

    /**
     * Get isOnHome
     *
     * @return boolean
     */
    public function getIsOnHome()
    {
        return $this->isOnHome;
    }
}
