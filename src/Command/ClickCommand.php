<?php

namespace OctoLab\Click\Command;

use Cilex\Command\Command;
use OctoLab\Click\Repository\LinkRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class ClickCommand extends Command
{
    /**
     * @return LoggerInterface
     */
    protected function getLogger()
    {
        return $this->getService('logger');
    }

    /**
     * @return LinkRepository
     */
    protected function getRepository()
    {
        return $this->getService('repository');
    }

    /**
     * {@inheritdoc}
     *
     * Reserved:
     * -h, --help
     * -q, --quiet
     * -V, --version
     *     --ansi
     *     --no-ansi
     * -n, --no-interaction
     * -v|vv|vvv, --verbose
     *
     * @return $this
     */
    protected function configure()
    {
        return $this
            ->addOption('user', 'u', InputOption::VALUE_REQUIRED, 'User.')
            ->addOption('env', 'e', InputOption::VALUE_OPTIONAL, 'Environment.', 'default')
        ;
    }
}
