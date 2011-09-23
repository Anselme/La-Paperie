<?php

namespace Lapaperie\CompaniesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\CompaniesBundle\Entity\Residence
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\CompaniesBundle\Entity\ResidenceRepository")
 */
class Residence
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
     * @var date $date_front
     *
     * @ORM\Column(name="date_front", type="date")
     */
    private $date_front;

    /**
     * @ORM\ManyToOne(targetEntity="Companie", inversedBy="residences")
     * @ORM\JoinColumn(name="companie_id", referencedColumnName="id")
     */
    protected $companie;


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
    public function setDateBeginning($dateBeginning)
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
    public function setDateEnd($dateEnd)
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
     * Set date_front
     *
     * @param date $dateFront
     */
    public function setDateFront($dateFront)
    {
        $this->date_front = $dateFront;
    }

    /**
     * Get date_front
     *
     * @return date
     */
    public function getDateFront()
    {
        return $this->date_front;
    }

    /**
     * Set companie
     *
     * @param Lapaperie\CompaniesBundle\Entity\Companie $companie
     */
    public function setCompanie(\Lapaperie\CompaniesBundle\Entity\Companie $companie)
    {
        $this->companie = $companie;
    }

    /**
     * Get companie
     *
     * @return Lapaperie\CompaniesBundle\Entity\Companie 
     */
    public function getCompanie()
    {
        return $this->companie;
    }
}