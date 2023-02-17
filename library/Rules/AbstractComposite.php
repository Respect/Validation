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

/**
 * Abstract class for rules that are composed by other rules.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Wojciech Frącz <fraczwojciech@gmail.com>
 */
abstract class AbstractComposite extends AbstractRule
{
    /**
     * @var Validatable[]
     */
    private $rules = [];

    /**
     * Initializes the rule adding other rules to the stack.
     */
    public function __construct(Validatable ...$rules)
    {
        $this->rules = $rules;
    }

    /**
     * {@inheritDoc}
     */
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

    /**
     * Append a rule into the stack of rules.
     *
     * @return AbstractComposite
     */
    public function addRule(Validatable $rule): self
    {
        if ($this->shouldHaveNameOverwritten($rule) && $this->getName() !== null) {
            $rule->setName($this->getName());
        }

        $this->rules[] = $rule;

        return $this;
    }

    /**
     * Returns all the rules in the stack.
     *
     * @return Validatable[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * Returns all the exceptions throw when asserting all rules.
     *
     * @param mixed $input
     *
     * @return ValidationException[]
     */
    protected function getAllThrownExceptions($input): array
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
