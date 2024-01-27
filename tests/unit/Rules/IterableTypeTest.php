<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\IterableType
 */
final class IterableTypeTest extends RuleTestCase
{
    /**
     * @return array<array{IterableType, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new stdClass()],
            [$rule, new ArrayIterator()],
        ];
    }

    /**
     * @return array<array{IterableType, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, 3],
            [$rule, 'asdf'],
            [$rule, 9.85],
            [$rule, null],
            [$rule, true],
        ];
    }
}
