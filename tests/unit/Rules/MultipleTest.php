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
 * @covers \Respect\Validation\Rules\Multiple
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class MultipleTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
