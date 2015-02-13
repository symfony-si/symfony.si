<?php

namespace SymfonySi\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SymfonySi\BlogBundle\Entity\Post;

class LoadPostData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post_1 = new Post();
        $post_1->setTitle('Welcome to the new site Symfony.si');
        $post_1->setIntro('New website is attended for PHP developers and users of Symfony PHP framework and for promotion of Symfony framework in Slovenia.');
        $post_1->setContent('Welcome to the new website Symfony.si. Page is interesting for PHP users of other frameworks and for those who have already used Symfony before. You will find useful advices and interesting information from Symfony world. Most of all you also have an opportunity to create this website along. It is open sourced and accessible on <a href="https://github.com/symfony-si/symfony.si">GitHub</a>. More Symfony information soon.
        ');
        $post_1->setSlug('welcome-to-symfony-si');
        $manager->persist($post_1);
        $manager->flush();
    }
}

