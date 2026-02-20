<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Trimmed::class)]
final class TrimmedTest extends RuleTestCase
{
    /** @return iterable<array{Trimmed, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Trimmed(), 'foo'],
            [new Trimmed(), 'foo bar'],
            [new Trimmed(), "foo\tbar"],
            [new Trimmed(), ''],
            [new Trimmed('foo', 'bar'), 'bazqux'],
            [new Trimmed('foo', 'bar'), 'oofbarf'],
        ];
    }

    /** @return iterable<array{Trimmed, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Trimmed(), ' foo'],
            [new Trimmed(), "foo\t"],
            [new Trimmed(), "\u{200B}foo"],
            [new Trimmed(), "foo\u{FEFF}"],
            [new Trimmed(), 123],
            [new Trimmed('foo', 'bar'), 'foobaz'],
            [new Trimmed('foo', 'bar'), 'bazbar'],
            [new Trimmed('foo', 'bar'), 'barbazfoo'],
        ];
    }
}
