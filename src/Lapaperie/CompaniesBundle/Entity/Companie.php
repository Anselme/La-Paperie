<?php

namespace Lapaperie\CompaniesBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var short_text
     *
     * @ORM\Column(name="short_text", type="text", nullable="true")
     */
    private $short_text;

    /**
     * @var long_text
     *
     * @ORM\Column(name="long_text", type="text", nullable="true")
     */
    private $long_text;

    /**
     * @ORM\OneToMany(targetEntity="Residence", mappedBy="companie")
     */
    protected $residences;

    /**
     * @ORM\OneToMany(targetEntity="Fabrique", mappedBy="companie")
     */
    protected $fabriques;

    /**
     * @ORM\OneToMany(targetEntity="ImageCompanie", mappedBy="companie")
     */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="Lapaperie\VideoBundle\Entity\Video", mappedBy="companie")
     */
    protected $videos;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->residences = new ArrayCollection();
        $this->fabriques = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * Set short_text
     *
     * @param text $shortText
     */
    public function setShortText($shortText)
    {
        $this->short_text = $shortText;
    }

    /**
     * Get short_text
     *
     * @return text
     */
    public function getShortText()
    {
        return $this->short_text;
    }

    /**
     * Set long_text
     *
     * @param text $longText
     */
    public function setLongText($longText)
    {
        $this->long_text = $longText;
    }

    /**
     * Get long_text
     *
     * @return text
     */
    public function getLongText()
    {
        return $this->long_text;
    }

    /**
     * Add images
     *
     * @param Lapaperie\CompaniesBundle\Entity\ImageCompanie $image
     */
    public function addImageCompanie(\Lapaperie\CompaniesBundle\Entity\ImageCompanie $image)
    {
        $this->images[] = $image;
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add videos
     *
     * @param Lapaperie\VideoBundle\Entity\Video $videos
     */
    public function addVideo(\Lapaperie\VideoBundle\Entity\Video $videos)
    {
        $this->videos[] = $videos;
    }

    /**
     * Get videos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Add residences
     *
     * @param Lapaperie\CompaniesBundle\Entity\Residence $residences
     */
    public function addResidence(\Lapaperie\CompaniesBundle\Entity\Residence $residences)
    {
        $this->residences[] = $residences;
    }

    /**
     * Get residences
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getResidences()
    {
        return $this->residences;
    }

    /**
     * Add fabriques
     *
     * @param Lapaperie\CompaniesBundle\Entity\Fabrique $fabriques
     */
    public function addFabrique(\Lapaperie\CompaniesBundle\Entity\Fabrique $fabriques)
    {
        $this->fabriques[] = $fabriques;
    }

    /**
     * Get fabriques
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFabriques()
    {
        return $this->fabriques;
    }
}