<?php

namespace AppBundle\Entity;

class Psr
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $readTime;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var Psr
     */
    private $meta;

    /**
     * @var Psr
     */
    private $examples;

    /**
     * Set title
     *
     * @param string $title
     * @return Psr
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Psr
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set read time
     *
     * @param string $readTime
     * @return Psr
     */
    public function setReadTime($readTime)
    {
        $this->readTime = $readTime;

        return $this;
    }

    /**
     * Get read time
     *
     * @return string
     */
    public function getReadTime()
    {
        return $this->readTime;
    }

    /**
     * Set updated time
     *
     * @param \DateTime $updated
     * @return Psr
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated time
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Psr
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Psr
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set meta document
     *
     * @param Psr $meta
     * @return Psr
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta document
     *
     * @return Psr
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set examples document
     *
     * @param Psr $examples
     * @return Psr
     */
    public function setExamples($examples)
    {
        $this->examples = $examples;

        return $this;
    }

    /**
     * Get examples document
     *
     * @return Psr
     */
    public function getExamples()
    {
        return $this->examples;
    }
}
