<?php

namespace Lapaperie\CompaniesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lapaperie\CompaniesBundle\Entity\Companie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\CompaniesBundle\Entity\CompanieRepository")
 */
class Companie
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var date $date_residence_beginning
     *
     * @ORM\Column(name="date_residence_beginning", type="date")
     */
    private $date_residence_beginning;

    /**
     * @var date $date_residence_end
     *
     * @ORM\Column(name="date_residence_end", type="date")
     */
    private $date_residence_end;

    /**
     * @var date $date_sortie_de_fabrique
     *
     * @ORM\Column(name="date_sortie_de_fabrique", type="date")
     */
    private $date_sortie_de_fabrique;


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date_residence_beginning
     *
     * @param date $dateResidenceBeginning
     */
    public function setDateResidenceBeginning($dateResidenceBeginning)
    {
        $this->date_residence_beginning = $dateResidenceBeginning;
    }

    /**
     * Get date_residence_beginning
     *
     * @return date 
     */
    public function getDateResidenceBeginning()
    {
        return $this->date_residence_beginning;
    }

    /**
     * Set date_residence_end
     *
     * @param date $dateResidenceEnd
     */
    public function setDateResidenceEnd($dateResidenceEnd)
    {
        $this->date_residence_end = $dateResidenceEnd;
    }

    /**
     * Get date_residence_end
     *
     * @return date 
     */
    public function getDateResidenceEnd()
    {
        return $this->date_residence_end;
    }

    /**
     * Set date_sortie_de_fabrique
     *
     * @param date $dateSortieDeFabrique
     */
    public function setDateSortieDeFabrique($dateSortieDeFabrique)
    {
        $this->date_sortie_de_fabrique = $dateSortieDeFabrique;
    }

    /**
     * Get date_sortie_de_fabrique
     *
     * @return date 
     */
    public function getDateSortieDeFabrique()
    {
        return $this->date_sortie_de_fabrique;
    }
}