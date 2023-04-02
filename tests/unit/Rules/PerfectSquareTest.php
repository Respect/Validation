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
 * @covers \Respect\Validation\Rules\PerfectSquare
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 */
final class PerfectSquareTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new PerfectSquare();

        return [
            [$rule, 1],
            [$rule, 9],
            [$rule, 25],
            [$rule, '25'],
            [$rule, 400],
            [$rule, '400'],
            [$rule, '0'],
            [$rule, 81],
            [$rule, 0],
            [$rule, 2500],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new PerfectSquare();

        return [
            [$rule, 250],
            [$rule, ''],
            [$rule, null],
            [$rule, 7],
            [$rule, -1],
            [$rule, 6],
            [$rule, 2],
            [$rule, '-1'],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
        ];
    }
}
