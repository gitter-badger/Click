<?php

namespace OctoLab\Click\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class RemoveCommand extends ClickCommand
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    protected function configure()
    {
        parent::configure()
            ->setName('click:remove')
            ->setDescription('Remove link from database.')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'Link ID.')
            ->addOption('alias', 'a', InputOption::VALUE_OPTIONAL, 'Link alias.')
            ->addOption('urn', null, InputOption::VALUE_OPTIONAL, 'Uniform Resource Name of source.')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Force remove from database.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = false;
        $id = $input->getOption('id');
        $alias = $input->getOption('alias');
        $urn = $input->getOption('urn');
        $force = filter_var($input->getOption('force'), FILTER_VALIDATE_BOOLEAN);
        if ($id) {
            $result = $this->getRepository()->removeById($id, $force);
        } elseif ($alias) {
            $result = $this->getRepository()->removeByAlias($alias, $force);
        } elseif ($urn) {
            $result = $this->getRepository()->removeByUrn($urn, $input->getOption('env'), $force);
        }
        return $result ? $this->success($output) : $this->failure($output);
    }
}
