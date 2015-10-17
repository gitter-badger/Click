<?php

namespace OctoLab\Click\Command;

use Cilex\Command\Command;
use OctoLab\Click\Repository\LinkRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->addOption('env', 'e', InputOption::VALUE_REQUIRED, 'Environment.', 'default');
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    protected function success(OutputInterface $output)
    {
        $output->writeln('<info>Success</info>');
        return 0;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    protected function failure(OutputInterface $output)
    {
        $output->writeln('<error>Failure</error>');
        return 1;
    }
}
