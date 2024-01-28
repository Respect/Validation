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

abstract class AbstractComposite extends AbstractRule
{
    /**
     * @var Validatable[]
     */
    private array $rules = [];

    public function __construct(Validatable ...$rules)
    {
        $this->rules = $rules;
    }

    public function setName(string $name): Validatable
    {
        $parentName = $this->getName();
        foreach ($this->rules as $rule) {
            $ruleName = $rule->getName();
            if ($ruleName && $parentName !== $ruleName) {
                continue;
            }

            $rule->setName($name);
        }

        return parent::setName($name);
    }

    public function addRule(Validatable $rule): self
    {
        if ($this->shouldHaveNameOverwritten($rule) && $this->getName() !== null) {
            $rule->setName($this->getName());
        }

        $this->rules[] = $rule;

        return $this;
    }

    /**
     * @return Validatable[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function assert(mixed $input): void
    {
        $exceptions = $this->getAllThrownExceptions($input);
        if (empty($exceptions)) {
            return;
        }

        $exception = $this->reportError($input);
        if ($exception instanceof NestedValidationException) {
            $exception->addChildren($exceptions);
        }

        throw $exception;
    }

    /**
     * @return ValidationException[]
     */
    private function getAllThrownExceptions(mixed $input): array
    {
        $exceptions = [];
        foreach ($this->getRules() as $rule) {
            try {
                $rule->assert($input);
            } catch (ValidationException $exception) {
                $this->updateExceptionTemplate($exception);
                $exceptions[] = $exception;
            }
        }

        return $exceptions;
    }

    private function shouldHaveNameOverwritten(Validatable $rule): bool
    {
        return $this->hasName($this) && !$this->hasName($rule);
    }

    private function hasName(Validatable $rule): bool
    {
        return $rule->getName() !== null;
    }

    private function updateExceptionTemplate(ValidationException $exception): void
    {
        if ($this->template === null || $exception->hasCustomTemplate()) {
            return;
        }

        $exception->updateTemplate($this->template);

        if (!$exception instanceof NestedValidationException) {
            return;
        }

        foreach ($exception->getChildren() as $childException) {
            $this->updateExceptionTemplate($childException);
        }
    }
}
