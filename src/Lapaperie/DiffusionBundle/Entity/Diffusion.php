<?php

namespace Lapaperie\DiffusionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Sluggable\Util\Urlizer;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Lapaperie\DiffusionBundle\Entity\Diffusion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\DiffusionBundle\Entity\DiffusionRepository")
 */
class Diffusion
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
    private $title;

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
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255, nullable="true")
     */
    private $path;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable="true")
     */
    private $name;

    /**
     * @var string $extension
     *
     * @ORM\Column(name="extension", type="string", length=255, nullable="true")
     */
    private $extension;

     /**
     * @Assert\File(maxSize = "1024k", mimeTypes = {"image/gif","image/jpeg","image/png" })
     */
    public $image;

     /**
     * @Assert\File(maxSize = "10000000")
     */
    public $file;

    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=255, nullable="true")
     */
    private $link;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"title"},unique="true", updatable="true")
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    function __construct()
    {
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

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }

        $extension = $this->image->guessExtension();
        if(!$extension)
        {
            $extension = 'bin' ;
        }

        $brand_new_name = uniqid().'.'.$extension ;

        // move takes the target directory and then the target filename to move to
        $this->image->move($this->getUploadRootDir(), $brand_new_name);

        // set the path property to the filename where you'ved saved the file
        $this->setPath($brand_new_name);

        // set the extension property to the filename where you'ved saved the file
        $this->setExtension($extension);

        // set the name
        $this->setName($brand_new_name);

        // clean up the file property as you won't need it anymore
        unset($this->image);
    }


    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/images';
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
     * Set link
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

}
