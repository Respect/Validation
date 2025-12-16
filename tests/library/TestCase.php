<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Respect\Validation\Validatable;

use function Respect\Stringifier\stringify;
use function sprintf;
use function strrchr;
use function substr;

abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @param mixed $input
     */
    public static function assertValidInput(Validatable $rule, $input): void
    {
        self::assertTrue(
            $rule->validate($input),
            sprintf(
                '%s should pass with %s',
                substr((string) strrchr($rule::class, '\\'), 1),
                stringify($rule->reportError($input)->getParams())
            )
        );
    }

    /**
     * @param mixed $input
     */
    public static function assertInvalidInput(Validatable $rule, $input): void
    {
        self::assertFalse(
            $rule->validate($input),
            sprintf(
                '%s should not pass with %s',
                substr((string) strrchr($rule::class, '\\'), 1),
                stringify($rule->reportError($input)->getParams())
            )
        );
    }
}
