<?php

namespace Probesys\Bundle\CmsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CmsControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('h1:contains("Dashboard")')->count() > 0);

        $crawler = $client->request('GET', '/');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

}
