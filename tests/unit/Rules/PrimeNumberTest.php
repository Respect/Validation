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
 * @covers \Respect\Validation\Rules\PrimeNumber
 * @covers \Respect\Validation\Exceptions\PrimeNumberException
 */
class PrimeNumberTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new PrimeNumber();
    }

    /**
     * @dataProvider providerForPrimeNumber
     */
    public function testPrimeNumber($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPrimeNumber
     * @expectedException \Respect\Validation\Exceptions\PrimeNumberException
     */
    public function testNotPrimeNumber($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForPrimeNumber()
    {
        return [
            [3],
            [5],
            [7],
            ['3'],
            ['5'],
            ['+7'],
        ];
    }

    public function providerForNotPrimeNumber()
    {
        return [
            [''],
            [null],
            [0],
            [10],
            [25],
            [36],
            [-1],
            ['-1'],
            ['25'],
            ['0'],
            ['a'],
            [' '],
            ['Foo'],
        ];
    }
}
