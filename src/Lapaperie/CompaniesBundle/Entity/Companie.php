<?php

namespace Lapaperie\CompaniesBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Sluggable\Util\Urlizer;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @var string $creation
     *
     * @ORM\Column(name="creation", type="string", length=255, nullable="true")
     */
    private $creation;

    /**
     * @var boolean $ispreviousYear
     *
     * @ORM\Column(name="isPreviousYear", type="boolean", nullable="true")
     */
    private $isPreviousYear;

    /**
     * @var integer $year
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var date $date_residence_beginning
     *
     * @ORM\Column(name="date_residence_beginning", type="date", nullable="true")
     */
    private $date_residence_beginning;

    /**
     * @var date $date_residence_end
     *
     * @ORM\Column(name="date_residence_end", type="date", nullable="true")
     */
    private $date_residence_end;

    /**
     * @var date $date_sortie_de_fabrique
     *
     * @ORM\Column(name="date_sortie_de_fabrique", type="date", nullable="true")
     */
    private $date_sortie_de_fabrique;

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
     * @ORM\OneToMany(targetEntity="ImageCompanie", mappedBy="companie")
     */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="Lapaperie\VideoBundle\Entity\Video", mappedBy="companie")
     */
    protected $videos;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"name"},unique="true", updatable="true")
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
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
     * Set date_residence_beginning
     *
     * @param date $dateResidenceBeginning
     */
    public function setDateResidenceBeginning(\DateTime $dateResidenceBeginning = null)
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
    public function setDateResidenceEnd(\DateTime $dateResidenceEnd = null)
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
    public function setDateSortieDeFabrique(\DateTime $dateSortieDeFabrique = null)
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
     * Set creation
     *
     * @param string $creation
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
    }

    /**
     * Get creation
     *
     * @return string
     */
    public function getCreation()
    {
        return $this->creation;
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set isPreviousYear
     *
     * @param boolean $isPreviousYear
     */
    public function setIsPreviousYear($isPreviousYear)
    {
        $this->isPreviousYear = $isPreviousYear;
    }

    /**
     * Get isPreviousYear
     *
     * @return boolean 
     */
    public function getIsPreviousYear()
    {
        return $this->isPreviousYear;
    }

    /**
     * Set year
     *
     * @param integer $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }
}