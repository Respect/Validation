<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\NotOptional
 */
final class NotOptionalTest extends RuleTestCase
{
    /**
     * @return array<array{NotOptional, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new NotOptional();

        return [
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

    /**
     * @return array<array{NotOptional, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new NotOptional();

        return [
            [$rule, null],
            [$rule, ''],
        ];
    }
}
