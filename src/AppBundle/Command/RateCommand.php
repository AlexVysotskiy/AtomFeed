<?php

namespace AppBundle\Command;

use AppBundle\Entity\Entry;
use AppBundle\Repository\EntryRepository;
use AppBundle\Service\ImportFeed;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class ImportCommand
 */
class RateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:rate_entry')
            ->addOption('entry', null, InputArgument::OPTIONAL, 'entry')
            ->addOption('score', null, InputArgument::OPTIONAL, 'score');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        /* @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        /* @var EntryRepository $repo */
        $repo = $em->getRepository(Entry::class);
        $repo->rateEntry($input->getOption('entry'), $input->getOption('score'));

        $output->writeln('Rated');
    }
}
