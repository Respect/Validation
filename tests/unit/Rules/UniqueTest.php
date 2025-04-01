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
 * @covers \Respect\Validation\Rules\Unique
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Krzysztof Śmiałek <admin@avensome.net>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class UniqueTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Unique();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, [true, false]],
            [$rule, ['alpha', 'beta', 'gamma', 'delta']],
            [$rule, [0, 2.71, 3.14]],
            [$rule, ['14.0', '14.1', '14.10']],
            [$rule, [[], ['str'], [1]]],
            [$rule, [(object) ['key' => 'value'], (object) ['other_key' => 'value']]],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Unique();

        return [
            [$rule, 'test'],
            [$rule, [1, 2, 2, 3]],
            [$rule, [1, 2, 3, 1]],
            [$rule, [true, false, false]],
            [$rule, ['alpha', 'beta', 'gamma', 'delta', 'beta']],
            [$rule, [0, 3.14, 2.71, 3.14]],
            [$rule, [[], [1], [1]]],
            [$rule, [(object) ['key' => 'value'], (object) ['key' => 'value']]],
            [$rule, [1, true, 'test']], // PHP's array_unique treats 1 and true as equal
        ];
    }
}
