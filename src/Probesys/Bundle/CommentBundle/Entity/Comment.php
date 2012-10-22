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
 * @subpackage CommentBundle
 * @author     Donovan Tengblad <contant@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probesys\Bundle\CommentBundle\Entity\Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Probesys\Bundle\CommentBundle\Entity\CommentRepository")
 */
class Comment
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
     * @var string $author
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string $authorEmail
     *
     * @ORM\Column(name="authorEmail", type="string", length=100)
     */
    private $authorEmail;

    /**
     * @var string $authorUrl
     *
     * @ORM\Column(name="authorUrl", type="string", length=200)
     */
    private $authorUrl;

    /**
     * @var string $authorIp
     *
     * @ORM\Column(name="authorIp", type="string", length=100)
     */
    private $authorIp;

    /**
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string $approved
     *
     * @ORM\Column(name="approved", type="string", length=20)
     */
    private $approved;

    /**
     * @var string $agent
     *
     * @ORM\Column(name="agent", type="string", length=255)
     */
    private $agent;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     * @var bigint $parent
     *
     * @ORM\Column(name="parent", type="bigint")
     */
    private $parent;

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
     * Set author
     *
     * @param  string  $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set authorEmail
     *
     * @param  string  $authorEmail
     * @return Comment
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    /**
     * Get authorEmail
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set authorUrl
     *
     * @param  string  $authorUrl
     * @return Comment
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;

        return $this;
    }

    /**
     * Get authorUrl
     *
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * Set authorIp
     *
     * @param  string  $authorIp
     * @return Comment
     */
    public function setAuthorIp($authorIp)
    {
        $this->authorIp = $authorIp;

        return $this;
    }

    /**
     * Get authorIp
     *
     * @return string
     */
    public function getAuthorIp()
    {
        return $this->authorIp;
    }

    /**
     * Set date
     *
     * @param  datetime $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set content
     *
     * @param  text    $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return text
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set approved
     *
     * @param  string  $approved
     * @return Comment
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return string
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set agent
     *
     * @param  string  $agent
     * @return Comment
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set type
     *
     * @param  string  $type
     * @return Comment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set parent
     *
     * @param  bigint  $parent
     * @return Comment
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return bigint
     */
    public function getParent()
    {
        return $this->parent;
    }
}
