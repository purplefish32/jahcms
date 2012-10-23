<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2012 Donovan Tengblad <contact@donovan-tengblad.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   Entity
 * @package    JahCMS
 * @subpackage PostBundle
 * @author     Donovan Tengblad <contact@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
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
     * @var integer $id ID
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text $postTitle Post title
     *
     * @ORM\Column(name="post_title", type="text")
     */
    private $postTitle;

    /**
     * @var datetime $postDate Post date
     *
     * @ORM\Column(name="post_date", type="datetime")
     */
    private $postDate;

    /**
     * @var string $postStatus Post date
     *
     * @ORM\Column(name="post_status", type="string", length=20)
     */
    private $postStatus;

    /**
     * @var datetime $postModified Post modified
     *
     * @ORM\Column(name="post_modified", type="datetime")
     */
    private $postModified;

    /**
     * @var Post $postChildren Post children
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="postParent")
     */
    private $postChildren;

    /**
     * @var Post $postParent Post parent
     *
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="postChildren")
     * @ORM\JoinColumn(name="post_parent", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $postParent;

    /**
     * @var string $postType Post type
     *
     * @ORM\Column(name="post_type", type="string", length=20)
     */
    private $postType;

    /**
     * @var string $postMimeType Post MIME type
     *
     * @ORM\Column(name="post_mime_type", type="string", length=100, nullable=true)
     */
    private $postMimeType;

    /**
     * @var PostMeta postMetas Post metas
     *
     * @ORM\OneToMany(targetEntity="PostMeta", mappedBy="post", cascade={"persist"})
     * @ORM\JoinColumn(name="post_meta_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $postMetas;

    /**
     * @return string $post_title
     */
    public function __toString()
    {
        return $this->getpostTitle();
    }

    /**
     * Constructor
     */
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
    public function setpostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return text
     */
    public function getpostTitle()
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
    public function setpostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return string
     */
    public function getpostStatus()
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
     * @param  Probesys\Bundle\PostBundle\Entity\PostMeta $postMetas
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
