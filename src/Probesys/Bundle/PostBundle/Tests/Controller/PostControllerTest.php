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

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        //$link = $crawler->filter('#post_new')->link();

        //$crawler = $client->click($link);

        //$this->assertTrue(200 === $client->getResponse()->getStatusCode());

        // // Fill in the form and submit it
        // $form = $crawler->selectButton('post_submit_action_publish')->form(array(
        //     'probesys_bundle_postbundle_posttype[postTitle]'   => 'Test',
        //     'probesys_bundle_postbundle_posttype[postContent]' => 'Test',
        //     // ... other fields to fill
        // ));

        // $client->submit($form);

        // $crawler = $client->followRedirect();

        // // Check data in the show view
        // $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

        // // Edit the entity
        // $crawler = $client->click($crawler->selectLink('Edit')->link());

        // $form = $crawler->selectButton('Edit')->form(array(
        //     'post[field_name]'  => 'Foo',
        //     // ... other fields to fill
        // ));

        // $client->submit($form);
        // $crawler = $client->followRedirect();

        // // Check the element contains an attribute with value equals "Foo"
        // $this->assertTrue($crawler->filter('[value="Foo"]')->count() > 0);

        // // Delete the entity
        // $client->submit($crawler->selectButton('Delete')->form());
        // $crawler = $client->followRedirect();

        // // Check the entity has been delete on the list
        // $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
