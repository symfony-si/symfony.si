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
            ->addOption('update-sources', null, InputOption::VALUE_NONE, 'If set the task will git pull docs sources from GitHub')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('update-sources')) {
            exec('cd doc/sources && git pull');
        }
        exec('sphinx-build -a -b html -c doc doc/sources web/doc/current');
        $output->writeln('Documentation generated');
    }
}
