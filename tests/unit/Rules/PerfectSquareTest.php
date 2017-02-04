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
 * @covers \Respect\Validation\Rules\PerfectSquare
 * @covers \Respect\Validation\Exceptions\PerfectSquareException
 */
class PerfectSquareTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new PerfectSquare();
    }

    /**
     * @dataProvider providerForPerfectSquare
     */
    public function testPerfectSquare($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPerfectSquare
     * @expectedException \Respect\Validation\Exceptions\PerfectSquareException
     */
    public function testNotPerfectSquare($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForPerfectSquare()
    {
        return [
            [1],
            [9],
            [25],
            ['25'],
            [400],
            ['400'],
            ['0'],
            [81],
            [0],
            [2500],
        ];
    }

    public function providerForNotPerfectSquare()
    {
        return [
            [250],
            [''],
            [null],
            [7],
            [-1],
            [6],
            [2],
            ['-1'],
            ['a'],
            [' '],
            ['Foo'],
        ];
    }
}
