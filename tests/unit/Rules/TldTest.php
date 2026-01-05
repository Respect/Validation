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

#[Group('validator')]
#[CoversClass(Tld::class)]
final class TldTest extends RuleTestCase
{
    /** @return iterable<array{Tld, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Tld();

        return [
            [$validator, 'br'],
            [$validator, 'cafe'],
            [$validator, 'com'],
            [$validator, 'democrat'],
            [$validator, 'eu'],
            [$validator, 'gmbh'],
            [$validator, 'us'],
        ];
    }

    /** @return iterable<array{Tld, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Tld();

        return [
            [$validator, '1'],
            [$validator, 1.0],
            [$validator, 'wrongtld'],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, true],
        ];
    }
}
