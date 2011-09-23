<?php

namespace Lapaperie\CompaniesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\CompaniesBundle\Entity\Fabrique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\CompaniesBundle\Entity\FabriqueRepository")
 */
class Fabrique
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
     * @var string $creationName
     *
     * @ORM\Column(name="creationName", type="string", length=255)
     */
    private $creationName;

    /**
     * @var date $dateSortie
     *
     * @ORM\Column(name="dateSortie", type="date")
     */
    private $dateSortie;

    /**
     * @ORM\ManyToOne(targetEntity="Companie", inversedBy="fabriques")
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
     * Set creationName
     *
     * @param string $creationName
     */
    public function setCreationName($creationName)
    {
        $this->creationName = $creationName;
    }

    /**
     * Get creationName
     *
     * @return string
     */
    public function getCreationName()
    {
        return $this->creationName;
    }

    /**
     * Set dateSortie
     *
     * @param date $dateSortie
     */
    public function setDateSortie($dateSortie)
    {
        $this->dateSortie = $dateSortie;
    }

    /**
     * Get dateSortie
     *
     * @return date
     */
    public function getDateSortie()
    {
        return $this->dateSortie;
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