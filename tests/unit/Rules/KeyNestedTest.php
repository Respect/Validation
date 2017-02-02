<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\KeyNested
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ivan Zinovyev <vanyazin@gmail.com>
 *
 * @since 1.0.0
 */
final class KeyNestedTest extends RuleTestCase
{
    /**
     * @return array
     */
    public function providerForValidInput(): array
    {
        $input1 = ['bar' => ['foo' => (object) ['baz' => 'hello world!']]];
        $input2 = [0 => 'Zero!'];
        $input3 = ['empty-key' => ''];
        $input4 = new ArrayObject([
            'bar' => [
                'foo' => [
                    'baz' => 'hello world!',
                ],
            ],
        ]);

        return [
            [new KeyNested('bar.foo.baz'), $input1],
            [new KeyNested('bar.foo'), $input1],
            [new KeyNested('bar.foo.'), $input1],
            [new KeyNested('bar.foo.baz', $this->createRuleMock('hello world!', true)), $input1],
            [new KeyNested(0, $this->createRuleMock('Zero!', true)), $input2],
            [new KeyNested('empty-key'), $input3],
            [new KeyNested('empty-key.nothing', $this->createRuleMock(null, false), false), $input3],
            [new KeyNested('bar.foo.baz'), $input4],
        ];
    }

    /**
     * @return array
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new KeyNested('bar.foo.baz'), ['bar' => ['foo' => ['qux' => 'hello world!']]]],
            [new KeyNested('bar.foo.'), ''],
            [new KeyNested('baz.bar'), 123],
        ];
    }
}
