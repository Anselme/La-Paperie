<?php

namespace Lapaperie\CompaniesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lapaperie\CompaniesBundle\Entity\imageCompanie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\CompaniesBundle\Entity\imageCompanieRepository")
 */
class imageCompanie
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
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $extension
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @ORM\ManyToOne(targetEntity="Companie", inversedBy="images")
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
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
     * Set extension
     *
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
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