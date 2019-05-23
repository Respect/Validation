<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\KeyValue
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KeyValueTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
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

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
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
