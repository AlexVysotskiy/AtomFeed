<?php

namespace AppBundle\Command;

use AppBundle\Service\ImportFeed;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class ImportCommand
 */
class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import_feed')
            ->addOption('url', null, InputArgument::OPTIONAL, 'url of feed')
            ->addOption('source', null, InputArgument::OPTIONAL, 'Id of source of feed')
            ->setDescription('Import entries from feed by url or source id.')
            ->setHelp('This command allows you to create a user...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        /* @var ImportFeed $importer */
        $importer = $this->getContainer()->get('feed_importer');

        if ($url = $input->getOption('url')) {
            $importer->importFromUrl($url);
        } elseif ($source = $input->getOption('source')) {
            $importer->importFromSource($source);
        }

        $output->writeln('Imported');
    }
}
