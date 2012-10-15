<?php
namespace Probesys\Bundle\PostBundle\Tests\Entity;

use Probesys\Bundle\PostBundle\Entity\Post;

class PageTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $post = new Post();
        $post->setPostTitle("My Page");
        $post->setPostType("page");

        $this->assertEquals($post->getPostTitle(), "My Page");
        $this->assertEquals($post, "My Page");
        $this->assertEquals($post->getPostType(), "page");
    }
}
