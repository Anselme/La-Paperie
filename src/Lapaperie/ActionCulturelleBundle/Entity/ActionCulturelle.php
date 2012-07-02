<?php

namespace Lapaperie\ActionCulturelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Sluggable\Util\Urlizer;
use Gedmo\Mapping\Annotation as Gedmo;

use Lapaperie\GalleryBundle\Entity\Gallery;

/**
 * Lapaperie\ActionCulturelleBundle\Entity\ActionCulturelle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\ActionCulturelleBundle\Entity\ActionCulturelleRepository")
 */
class ActionCulturelle
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var text $contenu
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var text $video
     *
     * @ORM\Column(name="video", type="text", nullable="true")
     */
    private $video;

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
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"title"},unique=true, updatable=true)
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="Lapaperie\GalleryBundle\Entity\Gallery", cascade={"persist"})
     */
    protected $gallery;

    /**
     * @ORM\OneToOne(targetEntity="Lapaperie\FileUploadBundle\Entity\FileUpload", cascade={"remove"})
     */
    protected $file;

    function __construct()
    {
        $this->gallery = new Gallery();
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
     * Set contenu
     *
     * @param text $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Get contenu
     *
     * @return text
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set video
     *
     * @param text $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * Get video
     *
     * @return text
     */
    public function getVideo()
    {
        return $this->video;
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
     * Set file
     *
     * @param Lapaperie\FileUploadBundle\Entity\FileUpload $file
     */
    public function setFile(\Lapaperie\FileUploadBundle\Entity\FileUpload $file)
    {
        $this->file = $file;
    }

    /**
     * Get file
     *
     * @return Lapaperie\FileUploadBundle\Entity\FileUpload
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set gallery
     *
     * @param Lapaperie\GalleryBundle\Entity\Gallery $gallery
     */
    public function setGallery(\Lapaperie\GalleryBundle\Entity\Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Get gallery
     *
     * @return Lapaperie\GalleryBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
