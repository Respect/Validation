<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Antonio Spinelli <tonicospinelli85@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Validator;

abstract class RuleTestCase extends TestCase
{
    /**
     * Data providers for valid results.
     *
     * It returns an array of arrays. Each array contains an instance of Rule
     * as the first element and an input in which the validation SHOULD pass.
     *
     * @return iterable<string|int, array{Validator, mixed}>
     */
    abstract public static function providerForValidInput(): iterable;

    /**
     * Data providers for invalid results.
     *
     * It returns an array of arrays. Each array contains an instance of Rule
     * as the first element and an input in which the validation SHOULD NOT pass.
     *
     * @return iterable<string|int, array{Validator, mixed}>
     */
    abstract public static function providerForInvalidInput(): iterable;

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldValidateValidInput(Validator $validator, mixed $input): void
    {
        self::assertValidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldValidateInvalidInput(Validator $validator, mixed $input): void
    {
        self::assertInvalidInput($validator, $input);
    }
}
