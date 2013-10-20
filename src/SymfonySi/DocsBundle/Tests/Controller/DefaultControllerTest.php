<?php

namespace SymfonySi\DocsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sl/documentation');

        $this->assertTrue($crawler->filter('html:contains("Dokumentacija")')->count() > 0);
    }
}
