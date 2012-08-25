<?php

namespace Probesys\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probesys\Bundle\PostBundle\Entity\Post
 *
 * @ORM\Table("pbs_posts")
 * @ORM\Entity(repositoryClass="Probesys\Bundle\PostBundle\Entity\PostRepository")
 */
class Post
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
     * @var text $postTitle
     *
     * @ORM\Column(name="post_title", type="text")
     */
    private $postTitle;

    /**
     * @var datetime $postDate
     *
     * @ORM\Column(name="post_date", type="datetime")
     */
    private $postDate;

    /**
     * @var string $postStatus
     *
     * @ORM\Column(name="post_status", type="string", length=20)
     */
    private $postStatus;

    /**
     * @var datetime $postModified
     *
     * @ORM\Column(name="post_modified", type="datetime")
     */
    private $postModified;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="postParent")
     */
    private $postChildren;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="postChildren")
     * @ORM\JoinColumn(name="post_parent", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $postParent;

    /**
     * @var string $postType
     *
     * @ORM\Column(name="post_type", type="string", length=20)
     */
    private $postType;

    /**
     * @var string $postMimeType
     *
     * @ORM\Column(name="post_mime_type", type="string", length=100, nullable=true)
     */
    private $postMimeType;

    /**
     * @ORM\OneToMany(targetEntity="PostMeta", mappedBy="post", cascade={"persist"})
     * @ORM\JoinColumn(name="post_meta_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $postMetas;

    /**
     * @return string $post_title
     */
    public function __toString()
    {
        return $this->getPostTitle();
    }

    public function __construct()
    {
        $this->post_children = new \Doctrine\Common\Collections\ArrayCollection();
        $postDate = new \DateTime();
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
     * Set postTitle
     *
     * @param  text $postTitle
     * @return Post
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return text
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postDate
     *
     * @param  datetime $postDate
     * @return Post
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return datetime
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set postStatus
     *
     * @param  string $postStatus
     * @return Post
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return string
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Set postModified
     *
     * @param  datetime $postModified
     * @return Post
     */
    public function setPostModified($postModified)
    {
        $this->postModified = $postModified;

        return $this;
    }

    /**
     * Get postModified
     *
     * @return datetime
     */
    public function getPostModified()
    {
        return $this->postModified;
    }

    /**
     * Set postType
     *
     * @param  string $postType
     * @return Post
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;

        return $this;
    }

    /**
     * Get postType
     *
     * @return string
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set postMimeType
     *
     * @param  string $postMimeType
     * @return Post
     */
    public function setPostMimeType($postMimeType)
    {
        $this->postMimeType = $postMimeType;

        return $this;
    }

    /**
     * Get postMimeType
     *
     * @return string
     */
    public function getPostMimeType()
    {
        return $this->postMimeType;
    }

    /**
     * Add postChildren
     *
     * @param  Probesys\Bundle\PostBundle\Entity\Post $postChildren
     * @return Post
     */
    public function addPostChildren(\Probesys\Bundle\PostBundle\Entity\Post $postChildren)
    {
        $this->postChildren[] = $postChildren;

        return $this;
    }

    /**
     * Remove postChildren
     *
     * @param <variableType$postChildren
     */
    public function removePostChildren(\Probesys\Bundle\PostBundle\Entity\Post $postChildren)
    {
        $this->postChildren->removeElement($postChildren);
    }

    /**
     * Get postChildren
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPostChildren()
    {
        return $this->postChildren;
    }

    /**
     * Set postParent
     *
     * @param  Probesys\Bundle\PostBundle\Entity\Post $postParent
     * @return Post
     */
    public function setPostParent(\Probesys\Bundle\PostBundle\Entity\Post $postParent = null)
    {
        $this->postParent = $postParent;

        return $this;
    }

    /**
     * Get postParent
     *
     * @return Probesys\Bundle\PostBundle\Entity\Post
     */
    public function getPostParent()
    {
        return $this->postParent;
    }


    /**
     * Add postMetas
     *
     * @param Probesys\Bundle\PostBundle\Entity\PostMeta $postMetas
     * @return Post
     */
    public function addPostMeta(\Probesys\Bundle\PostBundle\Entity\PostMeta $postMetas)
    {
        $this->postMetas[] = $postMetas;
        return $this;
    }

    /**
     * Remove postMetas
     *
     * @param Probesys\Bundle\PostBundle\Entity\PostMeta $postMetas
     */
    public function removePostMeta(\Probesys\Bundle\PostBundle\Entity\PostMeta $postMetas)
    {
        $this->postMetas->removeElement($postMetas);
    }

    /**
     * Get postMetas
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPostMetas()
    {
        return $this->postMetas;
    }
}