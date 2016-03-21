<?php

namespace Positibe\Bundle\OrmMediaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Sluggable\Util\Urlizer;
use Positibe\Bundle\OrmMediaBundle\Model\GalleryHasMediaInterface;
use Positibe\Bundle\OrmMediaBundle\Model\GalleryInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Gallery
 * @package Positibe\Bundle\OrmMediaBundle\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * @ORM\Table(name="positibe_gallery")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Gallery implements GalleryInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var GalleryHasMedia[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Positibe\Bundle\OrmMediaBundle\Entity\GalleryHasMedia", mappedBy="gallery", cascade="{"persist", "remove"}", orphanRemoval=TRUE, fetch="EXTRA_LAZY")
     */
    protected $galleryHasMedias;

    /**
     * @var string $name
     */
    protected $context;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, unique=TRUE)
     */
    protected $name;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    protected $enabled;

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

    protected $defaultFormat;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->galleryHasMedias = new ArrayCollection();
        $this->name = uniqid('gallery');
        $this->enabled = true;
        $this->defaultFormat = 'jpg';
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = Urlizer::urlize($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultFormat($defaultFormat)
    {
        $this->defaultFormat = $defaultFormat;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultFormat()
    {
        return $this->defaultFormat;
    }

    /**
     * {@inheritdoc}
     */
    public function setGalleryHasMedias($galleryHasMedias)
    {
        $this->galleryHasMedias = new ArrayCollection();

        foreach ($galleryHasMedias as $galleryHasMedia) {
            $this->addGalleryHasMedias($galleryHasMedia);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getGalleryHasMedias()
    {
        return $this->galleryHasMedias;
    }

    /**
     * {@inheritdoc}
     */
    public function addGalleryHasMedias(GalleryHasMediaInterface $galleryHasMedia)
    {
        $galleryHasMedia->setGallery($this);

        $this->galleryHasMedias[] = $galleryHasMedia;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName() ?: '-';
    }

    /**
     * @param string $context
     * @return string|void
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param GalleryHasMedia $galleryHasMedia
     * @return $this
     */
    public function addGalleryHasMedia(GalleryHasMedia $galleryHasMedia)
    {
        $galleryHasMedia->setGallery($this);

        $this->galleryHasMedias[] = $galleryHasMedia;

        return $this;
    }

    /**
     * @param GalleryHasMedia $galleryHasMedia
     * @return $this
     */
    public function removeGalleryHasMedia(GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedias->removeElement($galleryHasMedia);

        return $this;
    }
}