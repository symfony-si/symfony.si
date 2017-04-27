<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony.si', $crawler->filter('h1')->text());
    }

    public function testContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Contact', $crawler->filter('h1')->text());
    }

    public function testCopyright()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/copyrights');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Copyrights', $crawler->filter('h1')->text());
    }

    public function testContributors()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contributors');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Symfony.si contributors', $crawler->filter('h1')->text());
    }
}
