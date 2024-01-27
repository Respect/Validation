<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use const INF;
use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Infinite
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class InfiniteTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Infinite();

        return [
            [$rule, INF],
            [$rule, INF * -1],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Infinite();

        return [
            [$rule, ' '],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, '123456'],
            [$rule, -9],
            [$rule, 0],
            [$rule, 16],
            [$rule, 2],
            [$rule, PHP_INT_MAX],
        ];
    }
}
