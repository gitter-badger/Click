<?php

namespace OctoLab\Click\Command;

use OctoLab\Click\Entity\Link;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class SetCommand extends ClickCommand
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    protected function configure()
    {
        parent::configure()
            ->setName('click:set')
            ->setDescription('Update or add link to database.')
            ->addOption('urn', null, InputOption::VALUE_REQUIRED, 'Uniform Resource Name of source.')
            ->addOption('uri', null, InputOption::VALUE_REQUIRED, 'Uniform Resource Identifier of target.')
            ->addOption('alias', 'a', InputOption::VALUE_OPTIONAL, 'Source alias (set null if you want to delete it).')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $link = (new Link())
            ->setUserId($input->getOption('user'))
            ->setEnvironment($input->getOption('env'))
            ->setUrn($input->getOption('urn'))
            ->setUri($input->getOption('uri'))
        ;
        return 0;
    }
}
