<?php

namespace Lapaperie\FileUploadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lapaperie\FileUploadBundle\Entity\Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lapaperie\FileUploadBundle\Entity\FileUploadRepository")
 */
class FileUpload
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
     * @Assert\File(maxSize="10M")
     */
    public $file;

    /**
     * @var string $fileName
     *
     * @ORM\Column(name="fileName", type="string", length=255, nullable="true")
     */
    private $fileName;

    /**
     * @var string $filePath
     *
     * @ORM\Column(name="filePath", type="string", length=255, nullable="true")
     */
    private $filePath;

    /**
     * @var string $fileExtension
     *
     * @ORM\Column(name="fileExtension", type="string", length=255, nullable="true")
     */
    private $fileExtension;

    /**
     * @var string $fileSize
     *
     * @ORM\Column(name="fileSize", type="integer", nullable="true")
     */
    private $fileSize;

    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=255, nullable="true")
     */
    private $link;


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
     * Set fileName
     *
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set filePath
     *
     * @param string $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Get filePath
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getAbsoluteFilePath()
    {
        return null === $this->filePath ? null : $this->getUploadFileRootDir().'/'.$this->filePath;
    }

    public function getWebFilePath()
    {
        return null === $this->filePath ? null : $this->getUploadFileDir().'/'.$this->filePath;
    }

    protected function getUploadFileRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadFileDir();
    }

    protected function getUploadFileDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return '/uploads/documents';
    }

    public function uploadFile()
    {
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }

        $extension = $this->file->guessExtension();
        if(!$extension)
        {
            $extension = 'bin' ;
        }

        $brand_new_name = uniqid().'.'.$extension ;

        // set the size property to the filename where you'ved saved the file
        $this->setFileSize(filesize($this->file));

        // move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadFileRootDir(), $brand_new_name);

        // set the path property to the filename where you'ved saved the file
        $this->setFilePath($brand_new_name);

        // set the extension property to the filename where you'ved saved the file
        $this->setFileExtension($extension);

        // set the name
        $this->setFileName($brand_new_name);

        // clean up the file property as you won't need it anymore
        unset($this->file);
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

    /**
     * Set fileExtension
     *
     * @param string $fileExtension
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;
    }

    /**
     * Get fileExtension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Set fileSize
     *
     * @param int $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * Get fileSize
     *
     * @return int
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }
}
