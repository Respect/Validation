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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Fibonacci
 * @covers Respect\Validation\Exceptions\FibonacciException
 */
class FibonacciTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Fibonacci();
    }

    /**
     * @dataProvider providerForFibonacci
     */
    public function testFibonacci($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForFibonacci()
    {
        return [
            [1],
            [2],
            [3],
            [5],
            [8.0],
            ['3'],
            [21],
            ['21.0'],
            [34],
            ['34'],
            [1346269],
            [10610209857723]
        ];
    }

    /**
     * @dataProvider providerForNotFibonacci
     * @expectedException Respect\Validation\Exceptions\FibonacciException
     */
    public function testNotFibonacci($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNotFibonacci()
    {
        return [
            [0],
            [1346268],
            [''],
            [null],
            [7],
            [-1],
            [5.2],
            ['-1'],
            ['a'],
            [' '],
            [false],
            [true]
        ];
    }
}
