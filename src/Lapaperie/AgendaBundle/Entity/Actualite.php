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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable="true")
     */
    private $title;

    /**
     * @var boolean $showDefinition
     *
     * @ORM\Column(name="showDefinition", type="boolean", nullable="true")
     */
    private $showDefinition;

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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set showDefinition
     *
     * @param boolean $showDefinition
     */
    public function setShowDefinition($showDefinition)
    {
        $this->showDefinition= $showDefinition;
    }

    /**
     * Get showDefinition
     *
     * @return boolean
     */
    public function getShowDefinition()
    {
        return $this->showDefinition;
    }

}
