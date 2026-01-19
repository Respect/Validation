<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Krzysztof Śmiałek <admin@avensome.net>
 * SPDX-FileContributor: paul karikari <paulkarikari1@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Unique::class)]
final class UniqueTest extends RuleTestCase
{
    /** @return iterable<array{Unique, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Unique();

        return [
            [$validator, []],
            [$validator, [1, 2, 3]],
            [$validator, [true, false]],
            [$validator, ['alpha', 'beta', 'gamma', 'delta']],
            [$validator, [0, 2.71, 3.14]],
            [$validator, [[], ['str'], [1]]],
            [$validator, [(object) ['key' => 'value'], (object) ['other_key' => 'value']]],
        ];
    }

    /** @return iterable<array{Unique, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Unique();

        return [
            [$validator, 'test'],
            [$validator, [1, 2, 2, 3]],
            [$validator, [1, 2, 3, 1]],
            [$validator, [true, false, false]],
            [$validator, ['alpha', 'beta', 'gamma', 'delta', 'beta']],
            [$validator, [0, 3.14, 2.71, 3.14]],
            [$validator, [[], [1], [1]]],
            [$validator, [(object) ['key' => 'value'], (object) ['key' => 'value']]],
            [$validator, [1, true, 'test']], // PHP's array_unique treats 1 and true as equal
        ];
    }
}
