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

abstract class AbstractRelated extends AbstractRule
{
    public const TEMPLATE_NOT_PRESENT = 'not_present';
    public const TEMPLATE_INVALID = 'invalid';

    abstract public function hasReference(mixed $input): bool;

    abstract public function getReferenceValue(mixed $input): mixed;

    public function __construct(
        private readonly mixed $reference,
        private readonly ?Validatable $rule = null,
        private readonly bool $mandatory = true
    ) {

        if ($rule && $rule->getName() !== null) {
            $this->setName($rule->getName());
        } elseif (is_scalar($reference)) {
            $this->setName((string) $reference);
        }
    }

    public function getReference(): mixed
    {
        return $this->reference;
    }

    public function isMandatory(): bool
    {
        return $this->mandatory;
    }

    public function setName(string $name): Validatable
    {
        parent::setName($name);

        if ($this->rule instanceof Validatable) {
            $this->rule->setName($name);
        }

        return $this;
    }

    public function assert(mixed $input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input);
        }

        if ($this->rule === null || !$hasReference) {
            return;
        }

        try {
            $this->rule->assert($this->getReferenceValue($input));
        } catch (ValidationException $validationException) {
            /** @var NestedValidationException $nestedValidationException */
            $nestedValidationException = $this->reportError($input, ['name' => $this->reference]);
            $nestedValidationException->addChild($validationException);

            throw $nestedValidationException;
        }
    }

    public function check(mixed $input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input);
        }

        if ($this->rule === null || !$hasReference) {
            return;
        }

        $this->rule->check($this->getReferenceValue($input));
    }

    public function validate(mixed $input): bool
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

    public function getTemplate(mixed $input): string
    {
        if ($this->template !== null) {
            return $this->template;
        }

        if ($this->rule === null) {
            return self::TEMPLATE_NOT_PRESENT;
        }

        return $this->hasReference($input) ? self::TEMPLATE_INVALID : self::TEMPLATE_NOT_PRESENT;
    }
}
