<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\Core\Composite;
use Respect\Validation\Rules\Not;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;
use Throwable;

use function array_map;
use function count;
use function current;
use function sprintf;

trait CanExtractRules
{
    private function extractSingle(Validatable $rule, string $class): Validatable
    {
        if ($rule instanceof Validator) {
            return $this->extractSingleFromValidator($rule, $class);
        }

        if (!$rule instanceof $class) {
            throw new ComponentException(sprintf(
                'Could not extract rule %s from %s',
                $class,
                $rule::class,
            ));
        }

        return $rule;
    }

    private function extractSiblingSuitableRule(Validatable $rule, Throwable $throwable): Validatable
    {
        $this->assertSingleRule($rule, $throwable);

        if ($rule instanceof Validator) {
            return $rule->getRules()[0];
        }

        return $rule;
    }

    private function assertSingleRule(Validatable $rule, Throwable $throwable): void
    {
        if ($rule instanceof Not) {
            $this->assertSingleRule($rule->getRule(), $throwable);

            return;
        }

        if ($rule instanceof Validator) {
            if (count($rule->getRules()) !== 1) {
                throw $throwable;
            }

            $this->assertSingleRule($rule->getRules()[0], $throwable);

            return;
        }

        if ($rule instanceof Composite) {
            throw $throwable;
        }
    }

    /**
     * @param array<Validatable> $rules
     *
     * @return array<Validatable>
     */
    private function extractMany(array $rules, string $class): array
    {
        return array_map(fn (Validatable $rule) => $this->extractSingle($rule, $class), $rules);
    }

    private function extractSingleFromValidator(Validator $rule, string $class): Validatable
    {
        $rules = $rule->getRules();
        if (count($rules) !== 1) {
            throw new ComponentException(sprintf(
                'Validator must contain exactly one rule'
            ));
        }

        return $this->extractSingle(current($rules), $class);
    }
}
