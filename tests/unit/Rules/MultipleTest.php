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
#[CoversClass(Multiple::class)]
final class MultipleTest extends RuleTestCase
{
    /**
     * @return array<array{Multiple, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Multiple(5), 20],
            [new Multiple(5), 5],
            [new Multiple(5), 0],
            [new Multiple(5), -500],
            [new Multiple(1), 0],
            [new Multiple(1), 1],
            [new Multiple(1), 2],
            [new Multiple(1), 3],
            [new Multiple(0), 0], // Only 0 is multiple of 0
        ];
    }

    /**
     * @return array<array{Multiple, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Multiple(5), 11],
            [new Multiple(5), 3],
            [new Multiple(5), -1],
            [new Multiple(3), 4],
            [new Multiple(10), -8],
            [new Multiple(10), 57],
            [new Multiple(10), 21],
            [new Multiple(0), 1],
            [new Multiple(0), 2],
        ];
    }
}
