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

/**
 * @since 1.0.0
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
     * @return mixed[][]
     */
    abstract public static function providerForInvalidInput(): array;

    /**
     * @test
     * @dataProvider providerForValidInput
     */
    public function shouldValidateValidInput(Validatable $validator, mixed $input): void
    {
        self::assertValidInput($validator, $input);
    }

    /**
     * @test
     * @dataProvider providerForInvalidInput
     */
    public function shouldValidateInvalidInput(Validatable $validator, mixed $input): void
    {
        self::assertInvalidInput($validator, $input);
    }

    public static function fixture(?string $filename = null): string
    {
        $parts = [(string) realpath(__DIR__ . '/../fixtures')];
        if ($filename !== null) {
            $parts[] = ltrim($filename, '/');
        }

        return implode('/', $parts);
    }

    public static function assertValidInput(Validatable $rule, mixed $input): void
    {
        self::assertTrue(
            $rule->validate($input),
            sprintf('Validation with input %s is expected to pass', stringify($input))
        );
    }

    public static function assertInvalidInput(Validatable $rule, mixed $input): void
    {
        self::assertFalse(
            $rule->validate($input),
            sprintf('Validation with input %s it not expected to pass', stringify($input))
        );
    }
}
