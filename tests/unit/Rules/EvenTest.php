<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

use const INF;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Even
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class EvenTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Even(), 2],
            [new Even(), -2],
            [new Even(), 0],
            [new Even(), 32],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Even(), ''],
            [new Even(), INF],
            [new Even(), 2.2],
            [new Even(), -5],
            [new Even(), -1],
            [new Even(), 1],
            [new Even(), 13],
        ];
    }
}
