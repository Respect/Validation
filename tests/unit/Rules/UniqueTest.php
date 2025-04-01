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
            'empty' => [$rule, []],
            'integers' => [$rule, [1, 2, 3]],
            'booleans' => [$rule, [true, false]],
            'strings' => [$rule, ['alpha', 'beta', 'gamma', 'delta']],
            'floats' => [$rule, [2.71, 1.3, 3.14]],
            'numeric strings' => [$rule, ['14.0', '14.1', '14.10']],
            'integers + booleans' => [$rule, [1, true]],
            'integers + floats' => [$rule, [2.0, 2, 3.14]],
            'integers + floats + strings' => [$rule, [14.0, '14', '14.0']],
            'arrays' => [$rule, [[], ['str'], [1]]],
            'arrays (multidimensional)' => [
                $rule, [
                    ['key' => ['id' => 123, 'name' => 'Something']],
                    ['key' => ['id' => 122, 'name' => 'Something else']],
                ],
            ],
            'objects' => [$rule, [(object) ['key' => 'value'], (object) ['other_key' => 'value']]],
            'objects (same properties)' => [$rule, [(object) ['key' => 'value'], (object) ['key' => 'value']]],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Unique();
        $object = (object) ['key' => 'value'];

        return [
            'string' => [$rule, 'test'],
            'integers (2nd & 3rd)' => [$rule, [1, 2, 2, 3]],
            'integers (2nd & 4th)' => [$rule, [1, 2, 3, 1]],
            'booleans' => [$rule, [true, false, false]],
            'strings' => [$rule, ['alpha', 'beta', 'gamma', 'delta', 'beta']],
            'integers + floats' => [$rule, [0, 3.14, 2.71, 3.14]],
            'arrays' => [$rule, [[], [1], [1]]],
            'objects (single instance)' => [$rule, [$object, $object]],
            'arrays (multidimensional)' => [
                $rule, [
                    ['key' => ['id' => 123, 'name' => 'Something']],
                    ['key' => ['id' => 123, 'name' => 'Something']],
                ],
            ],
        ];
    }
}
