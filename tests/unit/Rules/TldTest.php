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
 *
 * @covers \Respect\Validation\Rules\Tld
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 * @author Paulo Eduardo <pauloelr@gmail.com>
 */
final class TldTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Tld();

        return [
            [$rule, 'br'],
            [$rule, 'cafe'],
            [$rule, 'com'],
            [$rule, 'democrat'],
            [$rule, 'eu'],
            [$rule, 'gmbh'],
            [$rule, 'us'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Tld();

        return [
            [$rule, '1'],
            [$rule, 1.0],
            [$rule, 'wrongtld'],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, true],
        ];
    }
}
