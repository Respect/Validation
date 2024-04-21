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

#[Group('rule')]
#[CoversClass(StartsWith::class)]
final class StartsWithTest extends RuleTestCase
{
    /** @return iterable<array{StartsWith, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new StartsWith('foo'), ['foo', 'bar']],
            [new StartsWith('foo') ,'FOObarbaz'],
            [new StartsWith('foo') , 'foobarbaz'],
            [new StartsWith('foo') ,'foobazfoo'],
            [new StartsWith('1'), [1, 2, 3]],
            [new StartsWith('1', true), ['1', 2, 3]],
        ];
    }

    /** @return iterable<array{StartsWith, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new StartsWith(123), 123],
            [new StartsWith(123, true), 123],
            [new StartsWith('foo'), ''],
            [new StartsWith('bat'), ['foo', 'bar']],
            [new StartsWith('foo'), 'barfaabaz'],
            [new StartsWith('foo', true), 'FOObarbaz'],
            [new StartsWith('foo'), 'faabarbaz'],
            [new StartsWith('foo'), 'baabazfaa'],
            [new StartsWith('foo'), 'baafoofaa'],
            [new StartsWith('1', true), [1, '1', 3]],
        ];
    }
}
