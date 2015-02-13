<?php

namespace SymfonySi\EcosystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SymfonySi\EcosystemBundle\Entity\Project;

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

    }
}

