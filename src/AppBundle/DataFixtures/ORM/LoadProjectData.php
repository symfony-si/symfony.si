<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Project;

class LoadProjectData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $project_1 = new Project();
        $project_1->setTitle('Ogrodje Symfony');
        $project_1->setDescription('Prevod ogrodja Symfony');
        $project_1->setLink('https://github.com/symfony/symfony');
        $project_1->setRepository('https://github.com/symfony/symfony');
        $project_1->setSlug('symfony');
        $manager->persist($project_1);
        $manager->flush();

        $project_2 = new Project();
        $project_2->setTitle('Symfony.com');
        $project_2->setDescription('Prevod spletne strani Symfony.com');
        $project_2->setLink('https://github.com/symfony/symfony-marketing');
        $project_2->setRepository('https://github.com/symfony/symfony-marketing');
        $project_2->setSlug('symfony-marketing');
        $manager->persist($project_2);
        $manager->flush();

        $project_3 = new Project();
        $project_3->setTitle('Sonata Project');
        $project_3->setDescription('Prevod projekta Sonata Project');
        $project_3->setLink('https://github.com/sonata-project');
        $project_3->setRepository('https://github.com/sonata-project');
        $project_3->setSlug('sonata-project');
        $manager->persist($project_3);
        $manager->flush();

        $project_4 = new Project();
        $project_4->setTitle('EasyAdminBundle');
        $project_4->setDescription('Prevod Symfony paketa EasyAdminBundle');
        $project_4->setLink('https://github.com/javiereguiluz/EasyAdminBundle');
        $project_4->setRepository('https://github.com/javiereguiluz/EasyAdminBundle');
        $project_4->setSlug('easy-admin-bundle');
        $manager->persist($project_4);
        $manager->flush();

        $project_5 = new Project();
        $project_5->setTitle('Magento');
        $project_5->setDescription('Prevod Magento 1.x');
        $project_5->setLink('http://magento.com/');
        $project_5->setRepository('https://github.com/symfony-si/magento-sl_SI');
        $project_5->setSlug('magento');
        $manager->persist($project_5);
        $manager->flush();

        $project_6 = new Project();
        $project_6->setTitle('PHP: The Right Way');
        $project_6->setDescription('Prevod hitre enostavne za branje reference za PHP najboljše prakse, sprejete kodne standarde in povezave do avtoriziranih vodičev po spletu');
        $project_6->setLink('http://sl.phptherightway.com');
        $project_6->setRepository('https://github.com/symfony-si/php-the-right-way');
        $project_6->setSlug('php-the-right-way');
        $manager->persist($project_6);
        $manager->flush();

        $project_7 = new Project();
        $project_7->setTitle('PHP FIG');
        $project_7->setDescription('Prevod PHP standardov in priporočil');
        $project_7->setLink('http://php-fig.org');
        $project_7->setRepository('https://github.com/php-fig/fig-standards');
        $project_7->setSlug('php-fig-standards');
        $manager->persist($project_7);
        $manager->flush();

        $project_8 = new Project();
        $project_8->setTitle('Semver.org');
        $project_8->setDescription('Prevod semantičnih verzij');
        $project_8->setLink('http://semver.org/lang/sl');
        $project_8->setRepository('https://github.com/mojombo/semver.org');
        $project_8->setSlug('semantic-versioning');
        $manager->persist($project_8);
        $manager->flush();

        $project_9 = new Project();
        $project_9->setTitle('The PHP League');
        $project_9->setDescription('Slovenski prevod strani PHP lige paketov');
        $project_9->setLink('http://thephpleague.com/sl/');
        $project_9->setRepository('https://github.com/thephpleague/thephpleague.github.io');
        $project_9->setSlug('the-php-league');
        $manager->persist($project_9);
        $manager->flush();

        $project_10 = new Project();
        $project_10->setTitle('Yii framework');
        $project_10->setDescription('Slovenski prevod ogrodja Yii 2');
        $project_10->setLink('https://github.com/yiisoft/yii2');
        $project_10->setRepository('https://github.com/yiisoft/yii2');
        $project_10->setSlug('the-php-league');
        $manager->persist($project_10);
        $manager->flush();

        $project_11 = new Project();
        $project_11->setTitle('Bootstrap');
        $project_11->setDescription('Slovenski prevod Bootstrap');
        $project_11->setLink('http://symfony.si/bootstrap');
        $project_11->setRepository('https://github.com/symfony-si/bootstrap');
        $project_11->setSlug('bootstrap');
        $manager->persist($project_11);
        $manager->flush();

        $project_12 = new Project();
        $project_12->setTitle('Progit');
        $project_12->setDescription('Slovenski prevod knjige progit');
        $project_12->setLink('http://git-scm.com/book/sl');
        $project_12->setRepository('https://github.com/progit/progit2-sl');
        $project_12->setSlug('progit');
        $manager->persist($project_12);
        $manager->flush();

        $project_13 = new Project();
        $project_13->setTitle('Zend Framework 2');
        $project_13->setDescription('Slovenian translation of Zend Framework 2');
        $project_13->setLink('https://github.com/zendframework/zf2');
        $project_13->setRepository('https://github.com/zendframework/zf2');
        $project_13->setSlug('zend-framework-2');
        $manager->persist($project_13);
        $manager->flush();

    }
}
