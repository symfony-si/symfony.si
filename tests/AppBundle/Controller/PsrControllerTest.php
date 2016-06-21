<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PsrControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/psr');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Priporočila PHP standardov', $crawler->filter('h1')->text());
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/psr/psr-0-standard-avtomatskega-nalagalnika');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Standard avtomatskega nalagalnika', $crawler->filter('h1')->text());
    }
}
