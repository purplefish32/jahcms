<?php
namespace Probesys\Bundle\PostBundle\Tests\Entity;

use Probesys\Bundle\PostBundle\Entity\Post;

class PostTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $post = new Post();
        $post->setPostTitle("My post");
        $post->setPostType("post");

        $this->assertEquals($post->getPostTitle(), "My post");
        $this->assertEquals($post, "My post");
        $this->assertEquals($post->getPostType(), "post");
    }
}
