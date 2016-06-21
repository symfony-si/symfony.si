<?php

namespace AppBundle\Repository;

use Symfony\Component\Finder\Finder;
use AppBundle\Entity\Post;
use Mni\FrontYAML\Parser;

class PostRepository
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * PostRepository constructor.
     *
     * @param string $kernelRootDir
     * @param Parser $parser
     */
    public function __construct($kernelRootDir, Parser $parser)
    {
        $this->path = $kernelRootDir;
        $this->parser = $parser;
    }

    /**
     * Gets all Blog posts.
     *
     * @return array
     */
    public function findAll()
    {
        $finder = new Finder();
        $finder->files()->in($this->path.'/Resources/content/blog');
        $finder->files()->name('*.md');
        $finder->sort(function ($a, $b) { return strcmp($b->getRealpath(), $a->getRealpath()); });

        $posts = [];
        foreach ($finder as $file) {
            $post = $this->getPostByFile($file->getRealPath());
            $posts[] = $post;
        }

        return $posts;
    }

    /**
     * Find one Post by parameters.
     *
     * @param array $params Search parameters.
     * @return null|Post
     */
    public function findOneBy(array $params) {
        $finder = new Finder();
        $fileName = $params['year'].'-'.$params['month'].'-'.$params['day'].($params['num'] === 0 ? '' : '-'.$params['num']).'.md';
        $finder->files()->in($this->path.'/Resources/content/blog')->name($fileName);
        $iterator = $finder->getIterator();
        $iterator->rewind();
        $file = $iterator->current();

        $post = $this->getPostByFile($file->getRealPath());

        if ($finder->count() == 0 || $params['slug'] != $post->getSlug()) {
            return null;
        }

        return $post;
    }

    /**
     * Find limited latest posts.
     *
     * @param int $limit
     * @return null|array
     */
    public function findLatest($limit = 10)
    {
        $finder = new Finder();
        $finder->files()->in($this->path.'/Resources/content/blog');
        $finder->files()->name('*.md');
        $finder->sort(function ($a, $b) { return strcmp($b->getRealpath(), $a->getRealpath()); });

        $posts = [];
        foreach (new \LimitIterator($finder->getIterator(), 0, $limit) as $file) {
            $post = $this->getPostByFile($file->getRealPath());
            $posts[] = $post;
        }

        return $posts;
    }

    /**
     * @param string $file
     * @return Post|null
     */
    public function getPostByFile($file)
    {
        if (!file_exists($file)) {
            return null;
        }

        $document = $this->parser->parse(file_get_contents($file));

        $post = new Post();
        $post->setTitle($document->getYaml()['title']);
        $post->setReadTime($document->getYaml()['read_time']);
        $post->setIntro($document->getYaml()['intro']);
        $post->setCreated(substr(basename($file), 0, 10));
        $post->setUpdated($document->getYAML()['updated']);
        $post->setNum(substr(basename($file), 11, -3));
        $post->setSlug($document->getYaml()['slug']);
        $post->setContent($document->getContent());
        $post->setFile(basename($file));

        return $post;
    }
}
