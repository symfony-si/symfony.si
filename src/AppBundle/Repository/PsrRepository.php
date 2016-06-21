<?php

namespace AppBundle\Repository;

use Symfony\Component\Finder\Finder;
use AppBundle\Entity\Psr;
use Mni\FrontYAML\Parser;

class PsrRepository
{
    public function __construct($kernelRootDir)
    {
        $this->path = $kernelRootDir;
    }

    /**
     * return array
     */
    public function findAll()
    {
        $finder = new Finder();
        $finder->files()->in($this->path.'/../vendor/symfony-si/fig-standards-sl/accepted');
        $finder->files()->name('*md');
        $finder->sortByName();

        $psrs = [];
        foreach ($finder as $file) {
            if (substr($file->getFileName(), -7) != 'meta.md' && substr($file->getFileName(), -11) != 'examples.md') {
                $psrs[] = $this->getPsrByFile($file->getRealPath());
            }
        }

        return $psrs;
    }

    /**
     * @param string $slug
     * @return Psr
     */
    public function findOneBySlug($slug)
    {
        $finder = new Finder();
        $finder->files()->in($this->path.'/../vendor/symfony-si/fig-standards-sl/accepted')->name("*.md");
        $finder->sortByName();

        $parser = new Parser();
        foreach ($finder as $file) {
            $document = $parser->parse($file->getContents());
            if ($document->getYAML()['slug'] == $slug) {
                return $this->getPsrByFile($file->getRealPath());
            }
        }

        return null;
    }

    /**
     * @param string $file
     * @return null|Psr
     */
    public function getPsrByFile($file)
    {
        if (!file_exists($file)) {
            return null;
        }

        $psr = $this->getPsrByFileWithoutChilds($file);
        $metaFile = substr($file, 0, -3).'-meta.md';
        if (file_exists($metaFile)) {
            $meta = $this->getPsrByFileWithoutChilds($metaFile);
            $psr->setMeta($meta);
        }

        $examplesFile = substr($file, 0, -3).'-examples.md';
        if (file_exists($examplesFile)) {
            $examples = $this->getPsrByFileWithoutChilds($examplesFile);
            $psr->setExamples($examples);
        }

        return $psr;
    }

    /**
     * Get Psr without meta or example child documents.
     *
     * @param string $file
     * @return Psr
     */
    private function getPsrByFileWithoutChilds($file)
    {
        $parser = new Parser();
        $document = $parser->parse(file_get_contents($file));

        $psr = new Psr();
        $psr->setTitle($document->getYAML()['title']);
        $psr->setSlug($document->getYaml()['slug']);
        $psr->setContent($document->getContent());
        $psr->setReadTime($document->getYAML()['read_time']);
        $psr->setDescription($document->getYAML()['description']);
        $psr->setUpdated(\DateTime::createFromFormat('Y-m-d', $document->getYAML()['updated']));

        return $psr;
    }
}