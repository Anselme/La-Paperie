<?php

namespace Lapaperie\VideoBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\VideoBundle\Entity\ Video
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\VideoBundle\Entity\VideoRepository")
 */
class  Video
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
     * @var text $embded
     *
     * @ORM\Column(name="embded", type="text")
     */
    private $embded;

    /**
     * @var date $publicationDate
     *
     * @ORM\Column(name="publicationDate", type="date")
     */
    private $publicationDate;

    /**
     * @var boolean $isOnLine
     *
     * @ORM\Column(name="isOnLine", type="boolean")
     */
    private $isOnLine;

    /**
     * @var string $legend
     *
     * @ORM\Column(name="legend", type="string", length=255, nullable="true")
     */
    private $legend;

    /**
     * @var string $src
     *
     * @ORM\Column(name="src", type="string", length=512, nullable="true")
     */
    private $src;

    /**
     * @ORM\ManyToOne(targetEntity="Lapaperie\CompaniesBundle\Entity\Companie", inversedBy="videos")
     * @ORM\JoinColumn(name="companie_id", referencedColumnName="id", nullable="true")
     */
    protected $companie;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path_thumb", type="string", length=255)
     */
    private $pathThumb;

     /**
     * @Assert\File(maxSize = "1024k", mimeTypes = {"image/gif","image/jpeg","image/png" })
     */
    public $imageThumb;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name_thumb", type="string", length=255)
     */
    private $nameThumb;

    /**
     * @var string $extension
     *
     * @ORM\Column(name="extension_thumb", type="string", length=255)
     */
    private $extensionThumb;



    function __construct()
    {
        $this->setPublicationDate(new \DateTime());
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
     * Set embded
     *
     * @param text $embded
     */
    public function setEmbded($embded)
    {
        $this->embded = $embded;
    }

    /**
     * Get embded
     *
     * @return text
     */
    public function getEmbded()
    {
        return $this->embded;
    }

    /**
     * Set publicationDate
     *
     * @param date $publicationDate
     */
    public function setPublicationDate(\DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get publicationDate
     *
     * @return date
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set isOnLine
     *
     * @param boolean $isOnLine
     */
    public function setIsOnLine($isOnLine)
    {
        $this->isOnLine = $isOnLine;
    }

    /**
     * Get isOnLine
     *
     * @return boolean
     */
    public function getIsOnLine()
    {
        return $this->isOnLine;
    }

    /**
     * Set legend
     *
     * @param string $legend
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;
    }

    /**
     * Get legend
     *
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * Set companie
     *
     * @param Lapaperie\CompaniesBundle\Entity\Companie $companie
     */
    public function setCompanie(\Lapaperie\CompaniesBundle\Entity\Companie $companie = null)
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

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->imageThumb) {
            return;
        }

        $extension = $this->imageThumb->guessExtension();
        if(!$extension)
        {
            $extension = 'bin' ;
        }

        $brand_new_name = uniqid().'.'.$extension ;

        // move takes the target directory and then the target filename to move to
        $this->imageThumb->move($this->getUploadRootDir(), $brand_new_name);

        // set the path property to the filename where you'ved saved the file
        $this->setPathThumb($brand_new_name);

        // set the extension property to the filename where you'ved saved the file
        $this->setExtensionThumb($extension);

        // set the name
        $this->setNameThumb($brand_new_name);

        // clean up the file property as you won't need it anymore
        unset($this->imageThumb);
    }


    public function getAbsolutePath()
    {
        return null === $this->pathThumb ? null : $this->getUploadRootDir().'/'.$this->pathThumb;
    }

    public function getWebPath()
    {
        return null === $this->pathThumb ? null : $this->getUploadDir().'/'.$this->pathThumb;
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
     * Set pathThumb
     *
     * @param string $pathThumb
     */
    public function setPathThumb($pathThumb)
    {
        $this->pathThumb = $pathThumb;
    }

    /**
     * Get pathThumb
     *
     * @return string
     */
    public function getPathThumb()
    {
        return $this->pathThumb;
    }

    /**
     * Set nameThumb
     *
     * @param string $nameThumb
     */
    public function setNameThumb($nameThumb)
    {
        $this->nameThumb = $nameThumb;
    }

    /**
     * Get nameThumb
     *
     * @return string
     */
    public function getNameThumb()
    {
        return $this->nameThumb;
    }

    /**
     * Set extensionThumb
     *
     * @param string $extensionThumb
     */
    public function setExtensionThumb($extensionThumb)
    {
        $this->extensionThumb = $extensionThumb;
    }

    /**
     * Get extensionThumb
     *
     * @return string
     */
    public function getExtensionThumb()
    {
        return $this->extensionThumb;
    }

    /**
     * Set Src
     *
     * @param string $src
     *
     */
    public function setSrc()
    {
        $doc = new \DomDocument;
        $doc->loadHTML($this->embded);


        $elems = $doc->getElementsByTagName('*');
        foreach ( $elems as $elm ) {
            if ( $elm->hasAttribute('src') )
                $srcs[] = $elm->getAttribute('src');
        }

        $count = preg_match('/video\/(.*)\?/',$srcs[0],$numero); ;

        $this->src = "http://vimeo.com/".$numero[1] ;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

}
