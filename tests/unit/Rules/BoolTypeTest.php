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
 * @covers \Respect\Validation\Rules\BoolType
 *
 * @author Devin Torres <devin@devintorres.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BoolTypeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new BoolType();

        return [
            [$rule, true],
            [$rule, false],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new BoolType();

        return [
            [$rule, ''],
            [$rule, 'foo'],
            [$rule, 123123],
            [$rule, new stdClass()],
            [$rule, []],
            [$rule, 1],
            [$rule, 0],
            [$rule, null],
        ];
    }
}
