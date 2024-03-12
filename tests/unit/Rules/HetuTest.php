<?php

/*
 * Copyright (c) Ville Hukkamäki <vhukkamaki@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Hetu::class)]
final class HetuTest extends RuleTestCase
{
    /** @return iterable<array{Hetu, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Hetu();

        return [
            [$rule, '010106A9012'],
            [$rule, '290199-907A'],
            [$rule, '010199+9012'],
            [$rule, '280291+913L'],
            [$rule, '280291+923X'],
        ];
    }

    /** @return iterable<array{Hetu, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Hetu();

        return [
            [$rule, '010106_9012'],
            [$rule, '010106G9012'],
            [$rule, '010106Z9012'],
            [$rule, '010106A901G'],
            [$rule, '010106A901I'],
            [$rule, '010106A901O'],
            [$rule, '010106A901Q'],
            [$rule, '010106A901Z'],
            [$rule, '010106!9012'],
            [$rule, '010106'],
            [$rule, '01X199+9012'],
            [$rule, '01X199Z9012'],
            [$rule, '01X199T9012'],
            [$rule, '999999A9999'],
            [$rule, '999999A999F'],
            [$rule, '300201A1236'],
            [$rule, '290201A123J'],

            [$rule, null],
            [$rule, []],
            [$rule, false],
            [$rule, 42],
            [$rule, '127.0.0.1'],
            [$rule, new DateTime()],
        ];
    }
}
