<?php

namespace Tests\AppBundle\Twig;

use AppBundle\Twig\AppExtension;
use Mni\FrontYAML\Parser;

class AppExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider markdownProvider
     */
    public function testMarkdownToHtml($md, $expected)
    {
        $parser = new Parser();
        $appExtension = new AppExtension($parser);
        $html = $appExtension->markdownToHtml($md);
        $this->assertEquals($html, $expected);
    }

    public static function markdownProvider()
    {
        return [
            [file_get_contents(__DIR__.'/../Fixtures/content_1.md'), file_get_contents(__DIR__.'/../Fixtures/content_1.html')]
        ];
    }
}