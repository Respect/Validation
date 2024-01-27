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

use function array_filter;
use function array_map;

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

    /**
     * @return ValidationException[]
     */
    protected function getAllThrownExceptions(mixed $input): array
    {
        return array_filter(
            array_map(
                function (Validatable $rule) use ($input): ?ValidationException {
                    try {
                        $rule->assert($input);
                    } catch (ValidationException $exception) {
                        $this->updateExceptionTemplate($exception);

                        return $exception;
                    }

                    return null;
                },
                $this->getRules()
            )
        );
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
