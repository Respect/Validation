<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use Respect\Validation\Validatable;

use function implode;
use function ltrim;
use function realpath;
use function Respect\Stringifier\stringify;
use function sprintf;
use function strrchr;
use function substr;

/**
 * Abstract class to create TestCases for Rules.
 *
 * @since 1.0.0
 *
 * @author Antonio Spinelli <tonicospinelli85@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
abstract class RuleTestCase extends TestCase
{
    /**
     * Data providers for valid results.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD pass.
     *
     * @api
     *
     * @return mixed[][]
     */
    abstract public static function providerForValidInput(): array;

    /**
     * Data providers for invalid results.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD NOT pass.
     *
     * @api
     *
     * @return mixed[][]
     */
    abstract public static function providerForInvalidInput(): array;

    /**
     * @test
     *
     * @dataProvider providerForValidInput
     *
     * @param mixed       $input
     */
    public function shouldValidateValidInput(Validatable $validator, $input): void
    {
        self::assertValidInput($validator, $input);
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInput
     *
     * @param mixed       $input
     */
    public function shouldValidateInvalidInput(Validatable $validator, $input): void
    {
        self::assertInvalidInput($validator, $input);
    }

    /**
     * Returns the directory used to store test fixtures.
     */
    public static function fixture(?string $filename = null): string
    {
        $parts = [(string) realpath(__DIR__ . '/../fixtures')];
        if ($filename !== null) {
            $parts[] = ltrim($filename, '/');
        }

        return implode('/', $parts);
    }

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
