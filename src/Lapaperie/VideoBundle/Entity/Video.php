<?php

namespace Lapaperie\VideoBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="Lapaperie\CompaniesBundle\Entity\Companie", inversedBy="videos")
     * @ORM\JoinColumn(name="companie_id", referencedColumnName="id", nullable="true")
     */
    protected $companie;


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
    public function setCompanie(\Lapaperie\CompaniesBundle\Entity\Companie $companie )
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
