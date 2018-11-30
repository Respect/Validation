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
 * @covers Respect\Validation\Rules\Digit
 * @covers Respect\Validation\Exceptions\DigitException
 */
class DigitTest extends TestCase
{
    /**
     * @dataProvider providerForValidDigits
     */
    public function testValidDataWithDigitsShouldReturnTrue($validDigits, $additional = '')
    {
        $validator = new Digit($additional);
        $this->assertTrue($validator->validate($validDigits));
    }

    /**
     * @dataProvider providerForInvalidDigits
     * @expectedException Respect\Validation\Exceptions\DigitException
     */
    public function testInvalidDigitsShouldFailAndThrowDigitException($invalidDigits, $additional = '')
    {
        $validator = new Digit($additional);
        $this->assertFalse($validator->validate($invalidDigits));
        $this->assertFalse($validator->assert($invalidDigits));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Digit($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Digit($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} 123'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n 123"],
        ];
    }

    public function providerForInvalidParams()
    {
        return [
            [new \stdClass()],
            [[]],
            [0x2],
        ];
    }

    public function providerForValidDigits()
    {
        return [
            ["\n\t"],
            [' '],
            [165],
            [1650],
            ['01650'],
            ['165'],
            ['1650'],
            ['16 50'],
            ["\n5\t"],
            ['16-50', '-'],
        ];
    }

    public function providerForInvalidDigits()
    {
        return [
            [''],
            [null],
            ['16-50'],
            ['a'],
            ['Foo'],
            ['12.1'],
            ['-12'],
            [-12],
        ];
    }
}
