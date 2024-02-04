<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(KeyValue::class)]
final class KeyValueTest extends RuleTestCase
{
    /** @return iterable<string, array{KeyValue, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'Equal values' => [new KeyValue('foo', 'equals', 'bar'), ['foo' => 42, 'bar' => 42]],
            'A value contained in an array' => [
                new KeyValue('password', 'in', 'valid_passwords'),
                [
                    'password' => 'shuberry',
                    'password_confirmation' => 'shuberry',
                    'valid_passwords' => ['shuberry', 'monty-python'],
                ],
            ],
        ];
    }

    /** @return iterable<string, array{KeyValue, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $keyValue = new KeyValue('foo', 'equals', 'bar');

        return [
            'Different values' => [$keyValue, ['foo' => 43, 'bar' => 42]],
            'Comparison key does not exist' => [$keyValue, ['bar' => 42]],
            'Base key does not exist' => [$keyValue, ['foo' => true]],
            'Rule is not valid' => [new KeyValue('foo', 'probably_not_a_rule', 'bar'), ['foo' => true, 'bar' => false]],
        ];
    }
}
