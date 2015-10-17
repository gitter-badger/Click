<?php

namespace OctoLab\Click\Command;

use OctoLab\Click\Entity\Link;
use OctoLab\Click\Exception\ValidationException;
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
            ->addOption('alias', 'a', InputOption::VALUE_OPTIONAL, 'Link alias (set null if you want to unset it).');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = false;
        $link = (new Link())
            ->setEnvironment($input->getOption('env'))
            ->setUrn($input->getOption('urn'))
            ->setUri($input->getOption('uri'));
        try {
            $preserveAlias = true;
            $alias = $input->getOption('alias');
            if ($alias === 'null') {
                $preserveAlias = false;
                $alias = null;
            }
            $link->setAlias($alias);
            $result = $this->getRepository()->set($link, $preserveAlias);
        } catch (ValidationException $e) {
            $output->writeln('<error>Validation exception:</error>');
            foreach ($e->getViolations() as $violation) {
                $output->writeln(sprintf('<error>- [%d] %s</error>', $violation->getCode(), $violation->getMessage()));
            }
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Exception %s: %s</error>', get_class($e), $e->getMessage()));
        }
        return $result ? $this->success($output) : $this->failure($output);
    }
}
