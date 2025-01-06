<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

use function is_scalar;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
abstract class AbstractRelated extends AbstractRule
{
    /**
     * @var bool
     */
    private $mandatory = true;

    /**
     * @var mixed
     */
    private $reference;

    /**
     * @var Validatable|null
     */
    private $rule;

    /**
     * @param mixed $input
     */
    abstract public function hasReference($input): bool;

    /**
     * @param mixed $input
     *
     * @return mixed
     */
    abstract public function getReferenceValue($input);

    /**
     * @param mixed $reference
     */
    public function __construct($reference, ?Validatable $rule = null, bool $mandatory = true)
    {
        $this->reference = $reference;
        $this->rule = $rule;
        $this->mandatory = $mandatory;

        if ($rule && $rule->getName() !== null) {
            $this->setName($rule->getName());
        } elseif (is_scalar($reference)) {
            $this->setName((string) $reference);
        }
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    public function isMandatory(): bool
    {
        return $this->mandatory;
    }

    /**
     * @deprecated Calling `setName()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::setName()} instead.
     */
    public function setName(string $name): Validatable
    {
        parent::setName($name);

        if ($this->rule instanceof Validatable) {
            $this->rule->setName($name);
        }

        return $this;
    }

    /**
     * @deprecated Calling `assert()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::assert()} instead.
     */
    public function assert($input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        if ($this->rule === null || !$hasReference) {
            return;
        }

        try {
            $this->rule->assert($this->getReferenceValue($input));
        } catch (ValidationException $validationException) {
            /** @var NestedValidationException $nestedValidationException */
            $nestedValidationException = $this->reportError($this->reference, ['hasReference' => true]);
            $nestedValidationException->addChild($validationException);

            throw $nestedValidationException;
        }
    }

    /**
     * @deprecated Calling `check()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::check()} instead.
     */
    public function check($input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        if ($this->rule === null || !$hasReference) {
            return;
        }

        $this->rule->check($this->getReferenceValue($input));
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            return false;
        }

        if ($this->rule === null || !$hasReference) {
            return true;
        }

        return $this->rule->validate($this->getReferenceValue($input));
    }
}
