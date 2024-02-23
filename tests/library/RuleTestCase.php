<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Validatable;

abstract class RuleTestCase extends TestCase
{
    /**
     * Data providers for valid results.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD pass.
     *
     * @api
     * @return iterable<string|int, array{Validatable, mixed}>
     */
    abstract public static function providerForValidInput(): iterable;

    /**
     * Data providers for invalid results.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD NOT pass.
     *
     * @api
     * @return iterable<string|int, array{Validatable, mixed}>
     */
    abstract public static function providerForInvalidInput(): iterable;

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldValidateValidInput(Validatable $validator, mixed $input): void
    {
        self::assertValidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldValidateInvalidInput(Validatable $validator, mixed $input): void
    {
        self::assertInvalidInput($validator, $input);
    }
}
