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
        $post->setPostDate("2012-10-15 08:12:47");
        $post->setPostModified("2012-10-15 08:12:47");
        $post->setPostStatus("published");

        $this->assertEquals($post->getPostTitle(), "My post");
        $this->assertEquals($post, "My post");
        $this->assertEquals($post->getPostType(), "post");
        $this->assertEquals($post->getPostDate(), "2012-10-15 08:12:47");
        $this->assertEquals($post->getPostModified(), "2012-10-15 08:12:47");
        $this->assertEquals($post->getPostStatus(), "published");
    }
}
