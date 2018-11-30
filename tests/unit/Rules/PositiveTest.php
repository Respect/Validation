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
 * @covers Respect\Validation\Rules\Positive
 * @covers Respect\Validation\Exceptions\PositiveException
 */
class PositiveTest extends TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Positive();
    }

    /**
     * @dataProvider providerForPositive
     */
    public function testPositive($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPositive
     * @expectedException Respect\Validation\Exceptions\PositiveException
     */
    public function testNotPositive($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForPositive()
    {
        return [
            [16],
            ['165'],
            [123456],
            [1e10],
        ];
    }

    public function providerForNotPositive()
    {
        return [
            [''],
            [null],
            ['a'],
            [' '],
            ['Foo'],
            ['-1.44'],
            [-1e-5],
            [0],
            [-0],
            [-10],
        ];
    }
}
