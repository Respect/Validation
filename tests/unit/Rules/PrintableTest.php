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

use function chr;

#[Group('rule')]
#[CoversClass(AbstractFilterRule::class)]
#[CoversClass(Printable::class)]
final class PrintableTest extends RuleTestCase
{
    /** @return iterable<array{Printable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Printable();

        return [
            [$rule, ' '],
            [$rule, 'LKA#@%.54'],
            [$rule, 'foobar'],
            [$rule, '16-50'],
            [$rule, '123'],
            [$rule, 'foo bar'],
            [$rule, '#$%&*_'],
            [new Printable("\t\n"), "\t\n "],
            [new Printable("\v\r"), "\v\r "],
        ];
    }

    /** @return iterable<array{Printable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Printable();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 'foo' . chr(7) . 'bar'],
            [$rule, 'foo' . chr(10) . 'bar'],
        ];
    }
}
