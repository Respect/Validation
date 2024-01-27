<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\NonNegatable;
use Respect\Validation\Validatable;

use function array_shift;
use function count;
use function current;
use function sprintf;

final class Not extends AbstractRule
{
    private Validatable $rule;

    public function __construct(Validatable $rule)
    {
        $this->rule = $this->extractNegatedRule($rule);
    }

    public function getNegatedRule(): Validatable
    {
        return $this->rule;
    }

    public function setName(string $name): Validatable
    {
        $this->rule->setName($name);

        return parent::setName($name);
    }

    public function validate(mixed $input): bool
    {
        return $this->rule->validate($input) === false;
    }

    public function assert(mixed $input): void
    {
        if ($this->validate($input)) {
            return;
        }

        $rule = $this->rule;
        if ($rule instanceof AllOf) {
            $rule = $this->absorbAllOf($rule, $input);
        }

        $exception = $rule->reportError($input);
        $exception->updateMode(ValidationException::MODE_NEGATIVE);

        throw $exception;
    }

    private function absorbAllOf(AllOf $rule, mixed $input): Validatable
    {
        $rules = $rule->getRules();
        while (($current = array_shift($rules))) {
            $rule = $current;
            if (!$rule instanceof AllOf) {
                continue;
            }

            if (!$rule->validate($input)) {
                continue;
            }

            $rules = $rule->getRules();
        }

        return $rule;
    }

    private function extractNegatedRule(Validatable $rule): Validatable
    {
        if ($rule instanceof NonNegatable) {
            throw new ComponentException(
                sprintf(
                    '"%s" can not be wrapped in Not()',
                    $rule::class
                )
            );
        }

        if ($rule instanceof self && $rule->getNegatedRule() instanceof self) {
            return $this->extractNegatedRule($rule->getNegatedRule()->getNegatedRule());
        }

        if (!$rule instanceof AllOf) {
            return $rule;
        }

        $rules = $rule->getRules();
        if (count($rules) === 1) {
            return $this->extractNegatedRule(current($rules));
        }

        return $rule;
    }
}
