<?php

namespace Probesys\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probesys\Bundle\PostBundle\Entity\PostMeta
 *
 * @ORM\Table("pbs_postmeta")
 * @ORM\Entity(repositoryClass="Probesys\Bundle\PostBundle\Entity\PostMetaRepository")
 */
class PostMeta
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
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="postMetas")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $post;

    /**
     * @var string $metaKey
     *
     * @ORM\Column(name="meta_key", type="string", length=255)
     */
    private $metaKey;

    /**
     * @var text $metaValue
     *
     * @ORM\Column(name="meta_value", type="text")
     */
    private $metaValue;

    public function __toString()
    {
        return $this->getMetaKey();
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
     * Set metaKey
     *
     * @param string $metaKey
     * @return PostMeta
     */
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;
        return $this;
    }

    /**
     * Get metaKey
     *
     * @return string
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     * Set metaValue
     *
     * @param text $metaValue
     * @return PostMeta
     */
    public function setMetaValue($metaValue)
    {
        $this->metaValue = $metaValue;
        return $this;
    }

    /**
     * Get metaValue
     *
     * @return text
     */
    public function getMetaValue()
    {
        return $this->metaValue;
    }

    /**
     * Set post
     *
     * @param Probesys\Bundle\PostBundle\Entity\Post $post
     * @return PostMeta
     */
    public function setPost(\Probesys\Bundle\PostBundle\Entity\Post $post = null)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Get post
     *
     * @return Probesys\Bundle\PostBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
}