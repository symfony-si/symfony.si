<?php

namespace AppBundle\Twig;

use Mni\FrontYAML\Parser;

/**
 * Application Twig extension which adds 'md2html' Twig filter for converting Markdown
 * content to HTML.
 */
class AppExtension extends \Twig_Extension
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * AppExtension constructor.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('md2html', [$this, 'markdownToHtml'], ['is_safe' => ['html']]),
        );
    }

    /**
     * Parses the given Markdown content and converts it HTML.
     *
     * @param string $content
     * @return string
     */
    public function markdownToHtml($content)
    {
        $document = $this->parser->parse($content);
        return $document->getContent();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app.extension';
    }
}
