<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function tmpfile;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Odd
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class OddTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Odd();

        return [
            [$rule, -5],
            [$rule, -1],
            [$rule, 1],
            [$rule, 13],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Odd();

        return [
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, tmpfile()],
            [$rule, true],
            [$rule, false],
            [$rule, ''],
            [$rule, -2],
            [$rule, -0],
            [$rule, 0],
            [$rule, 32],
        ];
    }
}
