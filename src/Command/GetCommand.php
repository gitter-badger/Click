<?php

namespace OctoLab\Click\Command;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class GetCommand extends ClickCommand
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    protected function configure()
    {
        return parent::configure()
            ->setName('click:get')
            ->setDescription('Get links from database.')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'Link ID.')
            ->addOption('alias', 'a', InputOption::VALUE_OPTIONAL, 'Link alias.')
            ->addOption('urn', null, InputOption::VALUE_OPTIONAL, 'Uniform Resource Name of source.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cols = [
            'id' => null,
            'urn' => null,
            'uri' => null,
            'alias' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ];
        $table = (new Table($output))
            ->setHeaders(['ID', 'URN', 'URI', 'Alias', 'Created at', 'Updated at', 'Deleted at'])
        ;
        $id = $input->getOption('id');
        $alias = $input->getOption('alias');
        $urn = $input->getOption('urn');
        if ($id) {
            $entry = $this->getRepository()->findById($id);
            if ($entry) {
                $table->addRow(array_intersect_key($entry, $cols));
            }
        } elseif ($alias) {
            $entry = $this->getRepository()->findByAlias($alias);
            if ($entry) {
                $table->addRow(array_intersect_key($entry, $cols));
            }
        } elseif ($urn) {
            $entry = $this->getRepository()->findByUrn($urn, $input->getOption('env'));
            if ($entry) {
                $table->addRow(array_intersect_key($entry, $cols));
            }
        } else {
            $entries = $this->getRepository()->findAll($input->getOption('env'));
            $table->addRows(array_map(function ($entry) use ($cols) {
                return array_intersect_key($entry, $cols);
            }, $entries));
        }
        $table->render();
        return 0;
    }
}
