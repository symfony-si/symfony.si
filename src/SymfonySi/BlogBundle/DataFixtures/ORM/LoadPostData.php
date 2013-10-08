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
        $post_1->setTitle('Pozdravljeni na novi strani Symfony.si');
        $post_1->setIntro('Nova stran Symfony.si je namenjena PHP razvijalcem in uporabnikom Symfony PHP ogrodja ter promociji Symfony ogrodja v Sloveniji.');
        $post_1->setContent('Pozdravljeni na novi spletni strani Symfony.si. Stran bo zanimiva tako za PHP uporabnike drugih ogrodij kot tudi za tiste, ki ste Symfony že uporabljali. Našli boste koristne nasvete in zanimive informacije iz sveta Symfony-ja, predvsem pa imate možnost stran tudi soustvarjati, saj je odprto dostopna na <a href="https://github.com/paradoxcode/symfony.si">GitHub-u</a>. Več Symfony informacij kmalu.
        ');
        $post_1->setSlug('welcome-to-symfony-si');
        $post_1->setTranslatableLocale('sl');
        $manager->persist($post_1);
        $manager->flush();
        
        $post_2 = $manager->getRepository('SymfonySi\BlogBundle\Entity\Post')->findOneBy(array('slug' => 'welcome-to-symfony-si'));
        $post_2->setTitle('Welcome to the new site Symfony.si');
        $post_2->setIntro('New website is attended for PHP developers and users of Symfony PHP framework and for promotion of Symfony framework in Slovenia.');
        $post_2->setContent('Welcome to the new website Symfony.si. Page is interesting for PHP users of other frameworks and for those who have already used Symfony before. You will find useful advices and interesting information from Symfony world. Most of all you also have an opportunity to create this website along. It is open sourced and accessible on <a href="https://github.com/paradoxcode/symfony.si">GitHub</a>. More Symfony information soon.
        ');
        $post_2->setTranslatableLocale('en');
        $manager->persist($post_2);
        $manager->flush();

    }
}

