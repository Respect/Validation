<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function acos;

use const INF;
use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(Finite::class)]
final class FiniteTest extends RuleTestCase
{
    /** @return iterable<array{Finite, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Finite();

        return [
            'integer-string' => [$sut, '123456'],
            'float-string' => [$sut, '123.456'],
            'zero' => [$sut, 0],
            'negative integer' => [$sut, PHP_INT_MAX * -1],
            'positive integer' => [$sut, PHP_INT_MAX],
            'positive float' => [$sut, 1.3e100],
            'negative float' => [$sut, 1.3e100 * -1],
        ];
    }

    /** @return iterable<array{Finite, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Finite();

        return [
            'empty' => [$sut, ''],
            'not a number' => [$sut, acos(1.01)],
            'infinite' => [$sut, INF],
            'negative infinite' => [$sut, INF * -1],
            'array' => [$sut, []],
            'object' => [$sut, new stdClass()],
            'null' => [$sut, null],
            'boolean false' => [$sut, false],
            'boolean true' => [$sut, true],
        ];
    }
}
