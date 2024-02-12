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

#[Group('rule')]
#[CoversClass(Control::class)]
final class ControlTest extends RuleTestCase
{
    /** @return iterable<array{Control, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Control();

        return [
            '\n' => [$sut, "\n"],
            '\r' => [$sut, "\r"],
            '\t' => [$sut, "\t"],
            '\n\r\t' => [$sut, "\n\r\t"],
            'Ignoring all characters' => [new Control('!@#$%^&*(){} '), '!@#$%^&*(){} '],
            'Ignoring some characters' => [new Control('[]?+=/\\-_|"\',<>. '), "[]?+=/\\-_|\"',<>. \t \n"],
        ];
    }

    /** @return iterable<array{Control, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Control();

        return [
            'empty parameter' => [$sut, ''],
            '16-50' => [$sut, '16-50'],
            'a' => [$sut, 'a'],
            'white space' => [$sut, ' '],
            'Foo' => [$sut, 'Foo'],
            '12.1' => [$sut, '12.1'],
            '"-12"' => [$sut, '-12'],
            '-12' => [$sut, -12],
            'alganet' => [$sut, 'alganet'],
            'empty array parameter' => [$sut, []],
            'object' => [$sut, new stdClass()],
        ];
    }
}
