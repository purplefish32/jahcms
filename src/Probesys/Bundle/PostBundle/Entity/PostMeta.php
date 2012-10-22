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
     * @param  string   $metaKey
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
     * @param  text     $metaValue
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
     * @param  Probesys\Bundle\PostBundle\Entity\Post $post
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
