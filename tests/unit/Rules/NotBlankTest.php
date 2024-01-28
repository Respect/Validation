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
#[CoversClass(NotBlank::class)]
final class NotBlankTest extends RuleTestCase
{
    /**
     * @return array<array{NotBlank, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $object = new stdClass();
        $object->foo = true;

        $rule = new NotBlank();

        return [
            [$rule, 1],
            [$rule, ' oi'],
            [$rule, [5]],
            [$rule, [1]],
            [$rule, $object],
        ];
    }

    /**
     * @return array<array{NotBlank, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new NotBlank();

        return [
            [$rule, null],
            [$rule, ''],
            [$rule, []],
            [$rule, ' '],
            [$rule, 0],
            [$rule, '0'],
            [$rule, 0],
            [$rule, '0.0'],
            [$rule, false],
            [$rule, ['']],
            [$rule, [' ']],
            [$rule, [0]],
            [$rule, ['0']],
            [$rule, [false]],
            [$rule, [[''], [0]]],
            [$rule, new stdClass()],
        ];
    }
}
