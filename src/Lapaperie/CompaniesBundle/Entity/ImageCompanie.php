<?php

namespace Lapaperie\CompaniesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\CompaniesBundle\Entity\ImageCompanie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\CompaniesBundle\Entity\ImageCompanieRepository")
 */
class ImageCompanie
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
     * @Assert\File(maxSize = "1024k", mimeTypes = {"image/gif","image/jpeg","image/png" })
     */
    public $image;

    /**
     * @ORM\ManyToOne(targetEntity="Companie", inversedBy="images")
     * @ORM\JoinColumn(name="companie_id", referencedColumnName="id")
     */
    protected $companie;

    public function __toString()
    {
        return $this->name;
    }

    public function upload($companie)
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

        // set the companie
        $this->setCompanie($companie);

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
