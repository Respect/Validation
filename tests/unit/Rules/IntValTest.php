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
 * @covers Respect\Validation\Rules\IntVal
 * @covers Respect\Validation\Exceptions\IntValException
 */
class IntValTest extends TestCase
{
    protected $intValidator;

    protected function setUp()
    {
        $this->intValidator = new IntVal();
    }

    /**
     * @dataProvider providerForInt
     */
    public function testValidIntegersShouldReturnTrue($input)
    {
        $this->assertTrue($this->intValidator->__invoke($input));
        $this->assertTrue($this->intValidator->check($input));
        $this->assertTrue($this->intValidator->assert($input));
    }

    /**
     * @dataProvider providerForNotInt
     * @expectedException Respect\Validation\Exceptions\IntValException
     */
    public function testInvalidIntegersShouldThrowIntException($input)
    {
        $this->assertFalse($this->intValidator->__invoke($input));
        $this->assertFalse($this->intValidator->assert($input));
    }

    public function providerForInt()
    {
        return [
            [16],
            ['165'],
            [123456],
            [PHP_INT_MAX],
            ['06'],
            ['0']
        ];
    }

    public function providerForNotInt()
    {
        return [
            [''],
            [null],
            ['a'],
            ['1.0'],
            [1.0],
            [' '],
            [true],
            [false],
            ['Foo'],
            ['1.44'],
            [1e-5],
        ];
    }
}
