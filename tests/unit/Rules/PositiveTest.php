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
 *
 * @covers \Respect\Validation\Rules\Positive
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ismael Elias <ismael.esq@hotmail.com>
 */
final class PositiveTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Positive();

        return [
            [$rule, 16],
            [$rule, '165'],
            [$rule, 123456],
            [$rule, 1e10],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Positive();

        return [
            [$rule, ''],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
            [$rule, '-1.44'],
            [$rule, -1e-5],
            [$rule, 0],
            [$rule, -0],
            [$rule, -10],
        ];
    }
}
