<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use stdClass;

/**
 * @group rule
 *
 * @covers Respect\Validation\Rules\Equals
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class EqualsTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Equals('foo'), 'foo'],
            [new Equals([]), []],
            [new Equals(new stdClass()), new stdClass()],
            [new Equals(10), '10'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Equals('foo'), ''],
            [new Equals('foo'), 'bar'],
        ];
    }

    /**
     * @test
     */
    public function shouldReturnComparedValueOnResult()
    {
        $compareTo = 'chimichanga';
        $rule = new Equals($compareTo);
        $result = $rule->validate('deadpool');

        $this->assertSame(['compareTo' => $compareTo], $result->getProperties());
    }
}
