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
        $post_1->setSlug('symfony-administration');

        $manager->persist($post_1);
        $manager->flush();
    }
}

