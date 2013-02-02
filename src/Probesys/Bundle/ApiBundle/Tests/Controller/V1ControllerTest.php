<?php

namespace Probesys\Bundle\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/posts.json');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/api/v1/posts.json/1');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

}
