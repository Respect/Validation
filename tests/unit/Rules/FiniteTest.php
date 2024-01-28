<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function acos;

use const INF;
use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(Finite::class)]
final class FiniteTest extends RuleTestCase
{
    /**
     * @return array<array{Finite, mixed}>
     */
    public static function providerForValidInput(): array
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

    /**
     * @return array<array{Finite, mixed}>
     */
    public static function providerForInvalidInput(): array
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
