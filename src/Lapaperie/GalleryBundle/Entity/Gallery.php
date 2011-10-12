<?php

namespace Lapaperie\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\GalleryBundle\Entity\Gallery
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\GalleryBundle\Entity\GalleryRepository")
 */
class Gallery
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
     *
     * @ORM\OneToMany(targetEntity="Image", mappedBy="gallery",cascade={"remove"})
     *
     */
    public $images;


    public function __construct()
    {
        $this->images = new ArrayCollection();
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
     * Add images
     *
     * @param Lapaperie\GalleryBundle\Entity\Image $images
     */
    public function addImage(\Lapaperie\GalleryBundle\Entity\Image $images)
    {
        $this->images[] = $images;
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
}