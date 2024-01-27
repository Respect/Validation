<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Negative
 */
final class NegativeTest extends RuleTestCase
{
    /**
     * @return array<array{Negative, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Negative();

        return [
            [$rule, '-1.44'],
            [$rule, -1e-5],
            [$rule, -10],
        ];
    }

    /**
     * @return array<array{Negative, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Negative();

        return [
            [$rule, ''],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, 0],
            [$rule, -0],
            [$rule, null],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
            [$rule, 16],
            [$rule, '165'],
            [$rule, 123456],
            [$rule, 1e10],
        ];
    }
}
