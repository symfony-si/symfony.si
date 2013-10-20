<?php

namespace SymfonySi\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sl/blog');

        $this->assertTrue($crawler->filter('html:contains("blog")')->count() > 0);
    }
}
