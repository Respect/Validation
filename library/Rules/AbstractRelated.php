<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Result;
use Respect\Validation\Validatable;

abstract class AbstractRelated extends AbstractRule
{
    public const TEMPLATE_NOT_PRESENT = '__not_present__';
    public const TEMPLATE_INVALID = '__invalid__';

    abstract public function hasReference(mixed $input): bool;

    abstract public function getReferenceValue(mixed $input): mixed;

    public function __construct(
        private readonly mixed $reference,
        private readonly ?Validatable $rule = null,
        private readonly bool $mandatory = true
    ) {
        $this->setName($rule?->getName() ?? (string) $reference);
    }

    public function evaluate(mixed $input): Result
    {
        $name = $this->getName() ?? (string) $this->reference;
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            return Result::failed($input, $this, self::TEMPLATE_NOT_PRESENT)->withNameIfMissing($name);
        }

        if ($this->rule === null || !$hasReference) {
            return Result::passed($input, $this, self::TEMPLATE_NOT_PRESENT)->withNameIfMissing($name);
        }

        $result = $this->rule->evaluate($this->getReferenceValue($input));

        return (new Result($result->isValid, $input, $this, self::TEMPLATE_INVALID))
            ->withChildren($result)
            ->withNameIfMissing($name);
    }

    public function getReference(): mixed
    {
        return $this->reference;
    }

    public function isMandatory(): bool
    {
        return $this->mandatory;
    }

    public function setName(string $name): static
    {
        parent::setName($name);
        $this->rule?->setName($name);

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

    protected function getStandardTemplate(mixed $input): string
    {
        if ($this->rule === null) {
            return self::TEMPLATE_NOT_PRESENT;
        }

        return $this->hasReference($input) ? self::TEMPLATE_INVALID : self::TEMPLATE_NOT_PRESENT;
    }
}
