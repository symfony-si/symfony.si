<?php

namespace SymfonySi\DocsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('docs:generate')
            ->setDescription('Generate html documents')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        exec('sphinx-build -b html -c doc doc/sources web/doc/current');
        $output->writeln('Documentation generated');
    }
}
