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
#[CoversClass(Tld::class)]
final class TldTest extends RuleTestCase
{
    /**
     * @return array<array{Tld, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Tld();

        return [
            [$rule, 'br'],
            [$rule, 'cafe'],
            [$rule, 'com'],
            [$rule, 'democrat'],
            [$rule, 'eu'],
            [$rule, 'gmbh'],
            [$rule, 'us'],
        ];
    }

    /**
     * @return array<array{Tld, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Tld();

        return [
            [$rule, '1'],
            [$rule, 1.0],
            [$rule, 'wrongtld'],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, true],
        ];
    }
}
