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

#[Group('validator')]
#[CoversClass(Space::class)]
final class SpaceTest extends RuleTestCase
{
    /** @return iterable<array{Space, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Space();

        return [
            'new line' => [$sut, "\n"],
            '1 space' => [$sut, ' '],
            '4 spaces' => [$sut, '    '],
            'tab' => [$sut, "\t"],
            '2 spaces' => [$sut, '  '],
            'characters "!@#$%^&*(){} "' => [new Space('!@#$%^&*(){}'), '!@#$%^&*(){} '],
            'characters "[]?+=/\\-_|\"\',<>. \t \n "' => [new Space('[]?+=/\\-_|"\',<>.'), "[]?+=/\\-_|\"',<>. \t \n "],
        ];
    }

    /** @return iterable<array{Space, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Space();

        return [
            'string empty' => [$sut, ''],
            'string 16-56' => [$sut, '16-50'],
            'string a' => [$sut, 'a'],
            'string Foo' => [$sut, 'Foo'],
            'string negative float' => [$sut, '12.1'],
            'string negative number' => [$sut, '-12'],
            'negative number ' => [$sut, -12],
            'underline' => [$sut, '_'],
        ];
    }
}
