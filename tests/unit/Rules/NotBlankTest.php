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
 * @covers \Respect\Validation\Rules\NotBlank
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NotBlankTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $object = new stdClass();
        $object->foo = true;

        $rule = new NotBlank();

        return [
            [$rule, 1],
            [$rule, ' oi'],
            [$rule, [5]],
            [$rule, [1]],
            [$rule, $object],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new NotBlank();

        return [
            [$rule, null],
            [$rule, ''],
            [$rule, []],
            [$rule, ' '],
            [$rule, 0],
            [$rule, '0'],
            [$rule, 0],
            [$rule, '0.0'],
            [$rule, false],
            [$rule, ['']],
            [$rule, [' ']],
            [$rule, [0]],
            [$rule, ['0']],
            [$rule, [false]],
            [$rule, [[''], [0]]],
            [$rule, new stdClass()],
        ];
    }
}
