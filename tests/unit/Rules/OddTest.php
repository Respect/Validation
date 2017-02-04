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
 * @covers \Respect\Validation\Rules\Odd
 * @covers \Respect\Validation\Exceptions\OddException
 */
class OddTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Odd();
    }

    /**
     * @dataProvider providerForOdd
     */
    public function testOdd($input)
    {
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotOdd
     * @expectedException \Respect\Validation\Exceptions\OddException
     */
    public function testNotOdd($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForOdd()
    {
        return [
            [-5],
            [-1],
            [1],
            [13],
        ];
    }

    public function providerForNotOdd()
    {
        return [
            [''],
            [-2],
            [-0],
            [0],
            [32],
        ];
    }
}
