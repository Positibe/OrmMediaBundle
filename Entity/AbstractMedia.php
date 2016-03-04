<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\OrmMediaBundle\Entity;

use Positibe\Bundle\OrmMediaBundle\Model\MediaInterface;
use Symfony\Cmf\Bundle\MediaBundle\BinaryInterface;
use Symfony\Cmf\Bundle\MediaBundle\FileSystemInterface;
use Symfony\Cmf\Bundle\MediaBundle\Model\AbstractMedia as CmfAbstractMedia;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class AbstractMedia
 * @package Positibe\Bundle\OrmMediaBundle\Entity
 *
 * @ORM\MappedSuperclass
 * @ORM\EntityListeners({"Positibe\Bundle\OrmMediaBundle\EventListener\MediaEntityListener"})
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
abstract class AbstractMedia extends CmfAbstractMedia implements FileSystemInterface, BinaryInterface, MediaInterface
{
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=TRUE)
     */
    protected $path;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=TRUE)
     */
    protected $description;

    /**
     * @var string $copyright
     *
     * @ORM\Column(name="copyright", type="string", length=255, nullable=TRUE)
     */
    protected $copyright;

    /**
     * @var string $authorName
     *
     * @ORM\Column(name="author_name", type="string", length=255, nullable=TRUE)
     */
    protected $authorName;

    /**
     * @var array $metadata
     *
     * @ORM\Column(name="metadata", type="array")
     */
    protected $metadata;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    protected $binaryContent;

    /**
     * @var string
     *
     * @ORM\Column(name="provider_name", type="string", length=255, nullable=TRUE)
     */
    protected $providerName = 'positibe_orm_media.image_provider';

    /**
     * @var integer $provider_status
     *
     * @ORM\Column(name="provider_status", type="integer")
     */
    protected $providerStatus;

    /**
     * @var string $provider_reference
     *
     * @ORM\Column(name="provider_reference", type="string", length=255)
     */
    protected $providerReference;

    /**
     * @var array $provider_metadata
     *
     * @ORM\Column(name="provider_metadata", type="array")
     */
    protected $providerMetadata = array();

    /**
     * @var string $content_type
     *
     * @ORM\Column(name="content_type", type="string", length=255)
     */
    protected $contentType;

    /**
     * @var integer $size
     * @ORM\Column(name="size", type="integer")
     */
    protected $size;

    /**
     * @var integer $width
     *
     * @ORM\Column(name="width", type="integer", nullable=TRUE)
     */
    protected $width;

    /**
     * @var integer $height
     *
     * @ORM\Column(name="height", type="integer", nullable=TRUE)
     */
    protected $height;

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContentAsString()
    {
        // TODO: Implement getContentAsString() method.
    }

    /**
     * Set the content
     *
     * @param string $content
     */
    public function setContentFromString($content)
    {
        $this->binaryContent = $content;
    }

    /**
     * Copy the content from a file, this allows to optimize copying the data
     * of a file. It is preferred to use the dedicated content setters if
     * possible.
     *
     * @param \SplFileInfo $file
     *
     * @throws \InvalidArgumentException if file is no FileInterface|\SplFileInfo
     */
    public function copyContentFromFile($file)
    {
        $this->binaryContent = $file;
    }

    /**
     * Returns the extension of the file
     *
     * @return string
     */
    public function getExtension()
    {
        // TODO: Implement getExtension() method.
    }

    /**
     * Get the path to the file on the file system.
     *
     * @return string
     */
    public function getFileSystemPath()
    {
        // TODO: Implement getFileSystemPath() method.
    }

    /**
     * Get the parent node.
     *
     * @return Object|null
     */
    public function getParent()
    {
        // TODO: Implement getParent() method.
    }

    /**
     * Set the parent node.
     *
     * @param Object $parent
     *
     * @return boolean
     */
    public function setParent($parent)
    {
        // TODO: Implement setParent() method.
    }

    /**
     * Get a php stream with the data of this file.
     *
     * @return mixed
     */
    public function getContentAsStream()
    {
        // TODO: Implement getContentAsStream() method.
    }

    /**
     * @param $stream
     */
    public function setContentFromStream($stream)
    {
        // TODO: Implement setContentFromStream() method.
    }

    /**
     * @return mixed
     */
    public function getBinaryContent()
    {
        return $this->binaryContent;
    }

    /**
     * @param mixed $binaryContent
     */
    public function setBinaryContent($binaryContent)
    {
        $this->binaryContent = $binaryContent;
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * @param string $providerName
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;
    }


    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    /**
     * {@inheritdoc}
     */
    public function setProviderStatus($providerStatus)
    {
        $this->providerStatus = $providerStatus;
    }

    /**
     * {@inheritdoc}
     */
    public function getProviderStatus()
    {
        return $this->providerStatus;
    }

    /**
     * {@inheritdoc}
     */
    public function setProviderReference($providerReference)
    {
        $this->providerReference = $providerReference;
    }

    /**
     * {@inheritdoc}
     */
    public function getProviderReference()
    {
        return $this->providerReference;
    }

    /**
     * {@inheritdoc}
     */
    public function setProviderMetadata(array $providerMetadata = array())
    {
        $this->providerMetadata = $providerMetadata;
    }

    /**
     * {@inheritdoc}
     */
    public function getProviderMetadata()
    {
        return $this->providerMetadata;
    }
    /**
     * {@inheritdoc}
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * {@inheritdoc}
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * {@inheritdoc}
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * {@inheritdoc}
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     * @return mixed|void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param $updatedAt
     * @return mixed|void
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


} 