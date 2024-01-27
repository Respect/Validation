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
 *
 * @covers \Respect\Validation\Rules\NoWhitespace
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class NoWhitespaceTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
