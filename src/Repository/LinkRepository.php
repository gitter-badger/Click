<?php

namespace OctoLab\Click\Repository;

use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class LinkRepository
{
    /** @var Connection */
    private $connection;
    /** @var ValidatorInterface */
    private $validator;
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param Connection $connection
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     */
    public function __construct(Connection $connection, ValidatorInterface $validator, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->validator = $validator;
        $this->logger = $logger;
    }
}
