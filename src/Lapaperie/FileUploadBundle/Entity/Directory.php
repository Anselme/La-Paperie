<?php

namespace Lapaperie\FileUploadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\FileUploadBundle\Entity\Directory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\FileUploadBundle\Entity\DirectoryRepository")
 */
class Directory
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
     * @ORM\OneToMany(targetEntity="FileUpload", mappedBy="directory",cascade={"remove"})
     *
     */
    public $fileUpload;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->name = "--";
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
     * Add fileUpload
     *
     * @param Lapaperie\FileUploadBundle\Entity\FileUpload $fileUpload
     */
    public function addImage(\Lapaperie\FileUploadBundle\Entity\FileUpload $fileUpload)
    {
        $this->fileUpload[] = $fileUpload;
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getFileUpload()
    {
        return $this->fileUpload;
    }
}
