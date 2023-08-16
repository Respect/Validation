<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Fibonacci
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Samuel Heinzmann <samuel.heinzmann@swisscom.com>
 */
final class FibonacciTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Fibonacci();

        return [
            [$rule, 1],
            [$rule, 2],
            [$rule, 3],
            [$rule, 5],
            [$rule, 8.0],
            [$rule, '3'],
            [$rule, 21],
            [$rule, 21.0],
            [$rule, '21.0'],
            [$rule, 34],
            [$rule, '34'],
            [$rule, 1346269],
            [$rule, 10610209857723],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Fibonacci();

        return [
            [$rule, 0],
            [$rule, 1346268],
            [$rule, ''],
            [$rule, null],
            [$rule, 7],
            [$rule, -1],
            [$rule, 5.2],
            [$rule, '-1'],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, false],
            [$rule, true],
        ];
    }
}
