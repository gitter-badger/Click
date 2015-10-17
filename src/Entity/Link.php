<?php

namespace OctoLab\Click\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class Link
{
    /**
     * @Assert\Type(type="int")
     *
     * @var int
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max="32")
     *
     * @var string
     */
    private $environment;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max="128")
     *
     * @var string
     */
    private $urn;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max="255")
     *
     * @var string
     */
    private $uri;
    /**
     * @Assert\Type(type="string")
     * @Assert\Length(max="32")
     * @Assert\Regex(pattern="/^\w+$/")
     *
     * @var string|null
     */
    private $alias;
    /**
     * @var \DateTime|null
     */
    private $createdAt;
    /**
     * @var \DateTime|null
     */
    private $updatedAt;
    /**
     * @var \DateTime|null
     */
    private $deletedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     *
     * @return $this
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrn()
    {
        return $this->urn;
    }

    /**
     * @param string $urn
     *
     * @return $this
     */
    public function setUrn($urn)
    {
        $this->urn = $urn;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     *
     * @return $this
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param null|string $alias
     *
     * @return $this
     */
    public function setAlias($alias = null)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     *
     * @return $this
     */
    public function setDeletedAt(\DateTime $deletedAt = null)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}
