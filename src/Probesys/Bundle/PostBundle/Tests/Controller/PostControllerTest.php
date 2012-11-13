<?php

namespace Probesys\Bundle\PostBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/admin/posts/');

        $this->assertTrue(
            200 === $client->getResponse()->getStatusCode()
        );

        $link = $crawler->filter('#post_new')->link();

        $crawler = $client->click($link);

        $this->assertTrue(
            200 === $client->getResponse()->getStatusCode()
        );

        // Fill in the form and submit it
        $form = $crawler
            ->selectButton('post_submit_action_publish')
            ->form(
                array(
                    'probesys_bundle_postbundle_posttype[postTitle]'   => 'Test',
                    'probesys_bundle_postbundle_posttype[postContent]' => 'Test',
                    // ... other fields to fill
                )
            )
        ;

        $client->submit($form);

        $crawler = $client->followRedirect();

        // // Check data in the show view
        $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

        // // Edit the entity
        $crawler = $client->click($crawler->filter('td:contains("Test")')->selectLink('edit')->link());

        $this->assertTrue(
            200 === $client->getResponse()->getStatusCode()
        );

        $form = $crawler->selectButton('post_submit_action_publish')->form(
            array(
                'probesys_bundle_postbundle_posttype[postTitle]' => 'Test2',
            )
        );

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertTrue(
            200 === $client->getResponse()->getStatusCode()
        );

        // Check the element contains an attribute with value equals "Foo"
        $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

        // Delete the entity
        $crawler = $client->click($crawler->filter('td:contains("Test")')->selectLink('delete')->link());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Test/', $client->getResponse()->getContent());

        // Delete non existing entity
        $crawler = $client->request('GET', '/admin/post/999999999999/delete');

        $this->assertTrue(
            404 === $client->getResponse()->getStatusCode()
        );
    }
}
