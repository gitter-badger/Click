<?php

namespace OctoLab\Click\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class ValidationException extends \InvalidArgumentException
{
    /** @var ConstraintViolationListInterface */
    private $violations;

    /**
     * @param ConstraintViolationListInterface $violations
     */
    public function __construct(ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;
        parent::__construct();
    }

    /**
     * @return ConstraintViolationInterface[]
     */
    public function getViolations()
    {
        return $this->violations;
    }
}
