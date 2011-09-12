<?php

namespace Lapaperie\FocusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lapaperie\FocusBundle\Entity\Focus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\FocusBundle\Entity\FocusRepository")
 */
class Focus
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
     * @var text $text
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var boolean $isOnLine
     *
     * @ORM\Column(name="isOnLine", type="boolean")
     */
    private $isOnLine;

    /**
     * @var date $publicationDate
     *
     * @ORM\Column(name="publicationDate", type="date")
     */
    private $publicationDate;

    /**
     * @var string $video
     *
     * @ORM\Column(name="video", type="string", length=510)
     */
    private $video;

    /**
     * @var string $legend
     *
     * @ORM\Column(name="legend", type="string", length=255)
     */
    private $legend;


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
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text
     */
    public function getText()
    {
        return $this->text;
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
     * Set publicationDate
     *
     * @param date $publicationDate
     */
    public function setPublicationDate($publicationDate)
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
     * Set video
     *
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
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
}
