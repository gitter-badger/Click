<?php

namespace OctoLab\Click\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use OctoLab\Click\Entity\Link;
use OctoLab\Click\Exception\ValidationException;
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

    /**
     * @param Link $link
     *
     * @return bool
     *
     * @throws ValidationException
     */
    public function add(Link $link)
    {
        $this->validate($link);
        $values = [
            'env' => ':env',
            'urn' => ':urn',
            'uri' => ':uri',
            'alias' => ':alias',
        ];
        $params = [
            ':env' => $link->getEnvironment(),
            ':urn' => $link->getUrn(),
            ':uri' => $link->getUri(),
            ':alias' => $link->getAlias(),
        ];
        $result = $this->connection->createQueryBuilder()
            ->insert('link')
            ->values($values)
            ->setParameters($params)
            ->execute();
        if ($result) {
            $link->setId($this->connection->lastInsertId('link_id_seq'));
        }
        return (bool)$result;
    }

    /**
     * @param int $id
     *
     * @return array
     * <pre>[
     *  'id':int,
     *  'env':string,
     *  'urn':string,
     *  'uri':string,
     *  'alias':null|string,
     *  'created_at':string,
     *  'updated_at':string,
     *  'deleted_at':null|string,
     * ]</pre>
     */
    public function findById($id)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('link')
            ->where('id = :id')
            ->setParameter(':id', $id)
            ->execute()
            ->fetch();
    }

    /**
     * @param string $alias
     *
     * @return array
     * @see findById
     */
    public function findByAlias($alias)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('link')
            ->where('alias = :alias')
            ->setParameter(':alias', $alias)
            ->execute()
            ->fetch();
    }

    /**
     * @param string $urn
     * @param string $env
     *
     * @return array
     * @see findById
     */
    public function findByUrn($urn, $env)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('link')
            ->where('env = :env AND urn = :urn')
            ->setParameters([
                ':env' => $env,
                ':urn' => $urn,
            ])
            ->execute()
            ->fetch();
    }

    /**
     * @param string $env
     *
     * @return array[]
     * @see findById
     */
    public function findAll($env)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('link')
            ->where('env = :env')
            ->setParameter(':env', $env)
            ->execute()
            ->fetchAll();
    }

    /**
     * @param Link $link
     * @param bool $preserveAlias false if you want to remove an alias from an existing link
     *
     * @return bool
     *
     * @throws ValidationException
     */
    public function set(Link $link, $preserveAlias = true)
    {
        if ($this->checkExists($link)) {
            $this->validate($link);
            $qb = $this->connection->createQueryBuilder()
                ->update('link')
                ->set('uri', ':uri')
                ->where('id = :id')
                ->setParameter(':id', $link->getId());
            if (!$preserveAlias || $link->getAlias() !== null) {
                $qb->set('alias', ':alias')->setParameter(':alias', $link->getAlias());
            }
            return (bool)$qb->execute();
        } else {
            return $this->add($link);
        }
    }

    /**
     * @param int $id
     * @param bool $force
     *
     * @return bool
     */
    public function removeById($id, $force = false)
    {
        if ($force) {
            return (bool)$this->connection->createQueryBuilder()
                ->delete('link')
                ->where('id = :id')
                ->setParameter(':id', $id)
                ->execute();
        } else {
            try {
                $stmt = $this->connection
                    ->executeQuery(
                        'UPDATE link SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id',
                        [':id' => $id]
                    );
                return $stmt->execute();
            } catch (DBALException $e) {
                return false;
            }
        }
    }

    /**
     * @param string $alias
     * @param bool $force
     *
     * @return bool
     */
    public function removeByAlias($alias, $force = false)
    {
        if ($force) {
            return (bool)$this->connection->createQueryBuilder()
                ->delete('link')
                ->where('alias = :alias')
                ->setParameter(':alias', $alias)
                ->execute();
        } else {
            try {
                $stmt = $this->connection
                    ->executeQuery(
                        'UPDATE link SET deleted_at = CURRENT_TIMESTAMP WHERE alias = :alias',
                        [':alias' => $alias]
                    );
                return $stmt->execute();
            } catch (DBALException $e) {
                return false;
            }
        }
    }

    /**
     * @param string $urn
     * @param string $env
     * @param bool $force
     *
     * @return bool
     */
    public function removeByUrn($urn, $env, $force = false)
    {
        if ($force) {
            return (bool)$this->connection->createQueryBuilder()
                ->delete('link')
                ->where('env = :env AND urn = :urn')
                ->setParameters([
                    ':env' => $env,
                    ':urn' => $urn,
                ])
                ->execute();
        } else {
            try {
                $stmt = $this->connection
                    ->executeQuery(
                        'UPDATE link SET deleted_at = CURRENT_TIMESTAMP WHERE env = :env AND urn = :urn',
                        [
                            ':env' => $env,
                            ':urn' => $urn,
                        ]
                    );
                return $stmt->execute();
            } catch (DBALException $e) {
                return false;
            }
        }
    }

    /**
     * @param Link $link
     *
     * @throws ValidationException
     */
    private function validate(Link $link)
    {
        $violations = $this->validator->validate($link);
        if ($violations->count()) {
            throw new ValidationException($violations);
        }
    }

    /**
     * @param Link $link
     *
     * @return bool
     */
    private function checkExists(Link $link)
    {
        $link->setId(
            (int)$this->connection->createQueryBuilder()
                ->select('id')
                ->from('link')
                ->where('env = :env AND urn = :urn')
                ->setParameters([
                    ':env' => $link->getEnvironment(),
                    ':urn' => $link->getUrn(),
                ])
                ->execute()
                ->fetchColumn()
        );
        return (bool)$link->getId();
    }
}
