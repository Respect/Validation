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
 * @covers \Respect\Validation\Rules\TrueVal
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class TrueValTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new TrueVal();

        return [
            [$rule, true],
            [$rule, 1],
            [$rule, '1'],
            [$rule, 'true'],
            [$rule, 'on'],
            [$rule, 'yes'],
            [$rule, 'TRUE'],
            [$rule, 'ON'],
            [$rule, 'YES'],
            [$rule, 'True'],
            [$rule, 'On'],
            [$rule, 'Yes'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new TrueVal();

        return [
            [$rule, false],
            [$rule, 0],
            [$rule, 0.5],
            [$rule, 2],
            [$rule, '0'],
            [$rule, 'false'],
            [$rule, 'off'],
            [$rule, 'no'],
            [$rule, 'truth'],
        ];
    }
}
