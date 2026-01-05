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

#[Group('validator')]
#[CoversClass(Printable::class)]
final class PrintableTest extends RuleTestCase
{
    /** @return iterable<array{Printable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Printable();

        return [
            [$validator, ' '],
            [$validator, 'LKA#@%.54'],
            [$validator, 'foobar'],
            [$validator, '16-50'],
            [$validator, '123'],
            [$validator, 'foo bar'],
            [$validator, '#$%&*_'],
            [new Printable("\t\n"), "\t\n "],
            [new Printable("\v\r"), "\v\r "],
        ];
    }

    /** @return iterable<array{Printable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Printable();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 'foo' . chr(7) . 'bar'],
            [$validator, 'foo' . chr(10) . 'bar'],
        ];
    }
}
