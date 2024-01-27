<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\NoWhitespace
 */
final class NoWhitespaceTest extends RuleTestCase
{
    /**
     * @return array<array{NoWhitespace, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new NoWhitespace();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 0],
            [$rule, 'wpoiur'],
            [$rule, 'Foo'],
        ];
    }

    /**
     * @return array<array{NoWhitespace, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new NoWhitespace();

        return [
            [$rule, ' '],
            [$rule, 'w poiur'],
            [$rule, '      '],
            [$rule, "Foo\nBar"],
            [$rule, "Foo\tBar"],
        ];
    }
}
