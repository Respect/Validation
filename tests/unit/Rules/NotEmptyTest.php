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
#[CoversClass(NotEmpty::class)]
final class NotEmptyTest extends RuleTestCase
{
    /**
     * @return array<array{NotEmpty, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new NotEmpty();

        return [
            [$rule, 1],
            [$rule, ' oi'],
            [$rule, [5]],
            [$rule, [0]],
            [$rule, new stdClass()],
        ];
    }

    /**
     * @return array<array{NotEmpty, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new NotEmpty();

        return [
            [$rule, ''],
            [$rule, '    '],
            [$rule, "\n"],
            [$rule, false],
            [$rule, null],
            [$rule, []],
        ];
    }
}
