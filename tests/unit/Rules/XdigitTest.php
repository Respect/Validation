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
#[CoversClass(Xdigit::class)]
final class XdigitTest extends RuleTestCase
{
    /** @return iterable<array{Xdigit, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Xdigit(), 'FFF'],
            [new Xdigit(), '15'],
            [new Xdigit(), 'DE12FA'],
            [new Xdigit(), '1234567890abcdef'],
            [new Xdigit(), 443],
            [new Xdigit(), 0x123],
            [new Xdigit('!@#$%^&*(){} '), '!@#$%^&*(){} abc 123'],
            [new Xdigit("[]?+=/\\-_|\"',<>. \t\n"), "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /** @return iterable<array{Xdigit, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Xdigit(), ''],
            [new Xdigit(), null],
            [new Xdigit(), 'j'],
            [new Xdigit(), ' '],
            [new Xdigit(), 'Foo'],
            [new Xdigit(), '1.5'],
        ];
    }
}
