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

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Multiple
 * @covers Respect\Validation\Exceptions\MultipleException
 */
class MultipleTest extends TestCase
{
    /**
     * @dataProvider providerForMultiple
     */
    public function testValidNumberMultipleOf($multipleOf, $input)
    {
        $multiple = new Multiple($multipleOf);
        $this->assertTrue($multiple->validate($input));
        $this->assertTrue($multiple->assert($input));
        $this->assertTrue($multiple->check($input));
    }

    /**
     * @dataProvider providerForNotMultiple
     * @expectedException Respect\Validation\Exceptions\MultipleException
     */
    public function testNotMultipleShouldThrowMultipleException($multipleOf, $input)
    {
        $multiple = new Multiple($multipleOf);
        $this->assertFalse($multiple->validate($input));
        $this->assertFalse($multiple->assert($input));
    }

    public function providerForMultiple()
    {
        return [
            ['', ''],
            [5, 20],
            [5, 5],
            [5, 0],
            [5, -500],
            [1, 0],
            [1, 1],
            [1, 2],
            [1, 3],
            [0, 0], // Only 0 is multiple of 0
        ];
    }

    public function providerForNotMultiple()
    {
        return [
            [5, 11],
            [5, 3],
            [5, -1],
            [3, 4],
            [10, -8],
            [10, 57],
            [10, 21],
            [0, 1],
            [0, 2],
        ];
    }
}
