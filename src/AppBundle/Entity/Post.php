<?php

namespace AppBundle\Entity;


/**
 * Post class.
 */
class Post
{
    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $intro;

    /**
     * @var string
     */
    private $readTime;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var int
     */
    private $num;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * Set file
     *
     * @param string $file
     * @return Post
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
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
     * Set intro
     *
     * @param string $intro
     * @return Post
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
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
     * @return Post
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
     * @param string $date
     */
    public function setCreated($date)
    {
        $this->created = \DateTime::createFromFormat('Y-m-d', $date);
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $date
     */
    public function setUpdated($date)
    {
        $this->updated = \DateTime::createFromFormat('Y-m-d', $date);
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set num
     *
     * @param int $id
     * @return Post
     */
    public function setNum($id)
    {
        $this->num = $id;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set read time
     *
     * @param string $readTime
     * @return Post
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

}