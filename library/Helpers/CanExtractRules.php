<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Composite;
use Respect\Validation\Rules\Not;
use Respect\Validation\Validator;
use Throwable;

use function count;

trait CanExtractRules
{
    private function extractSiblingSuitableRule(Rule $rule, Throwable $throwable): Rule
    {
        $this->assertSingleRule($rule, $throwable);

        if ($rule instanceof Validator) {
            return $rule->getRules()[0];
        }

        return $rule;
    }

    private function assertSingleRule(Rule $rule, Throwable $throwable): void
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
}
