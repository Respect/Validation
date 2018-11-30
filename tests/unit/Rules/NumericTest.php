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
 * @covers Respect\Validation\Rules\Numeric
 * @covers Respect\Validation\Exceptions\NumericException
 */
class NumericTest extends TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Numeric();
    }

    /**
     * @dataProvider providerForNumeric
     */
    public function testNumeric($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotNumeric
     * @expectedException Respect\Validation\Exceptions\NumericException
     */
    public function testNotNumeric($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNumeric()
    {
        return [
            [165],
            [165.0],
            [-165],
            ['165'],
            ['165.0'],
            ['+165.0'],
        ];
    }

    public function providerForNotNumeric()
    {
        return [
            [''],
            [null],
            ['a'],
            [' '],
            ['Foo'],
        ];
    }
}
