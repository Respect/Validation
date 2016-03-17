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
 * @covers Respect\Validation\Rules\Alnum
 * @covers Respect\Validation\Exceptions\AlnumException
 */
class AlnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidAlnum
     */
    public function testValidAlnumCharsShouldReturnTrue($validAlnum, $additional)
    {
        $validator = new Alnum($additional);
        $this->assertTrue($validator->validate($validAlnum));
    }

    /**
     * @dataProvider providerForInvalidAlnum
     * @expectedException Respect\Validation\Exceptions\AlnumException
     */
    public function testInvalidAlnumCharsShouldThrowAlnumExceptionAndReturnFalse($invalidAlnum, $additional)
    {
        $validator = new Alnum($additional);
        $this->assertFalse($validator->validate($invalidAlnum));
        $this->assertFalse($validator->assert($invalidAlnum));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Alnum($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Alnum($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} abc 123'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n abc 123"],
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

    public function providerForValidAlnum()
    {
        return [
            ['alganet', ''],
            ['alganet', 'alganet'],
            ['0alg-anet0', '0-9'],
            ['1', ''],
            ["\t", ''],
            ["\n", ''],
            ['a', ''],
            ['foobar', ''],
            ['rubinho_', '_'],
            ['google.com', '.'],
            ['alganet alganet', ''],
            ["\nabc", ''],
            ["\tdef", ''],
            ["\nabc \t", ''],
            [0, ''],
        ];
    }

    public function providerForInvalidAlnum()
    {
        return [
            ['', ''],
            ['@#$', ''],
            ['_', ''],
            ['dgç', ''],
            [1e21, ''], //evaluates to "1.0E+21"
            [null, ''],
            [new \stdClass(), ''],
            [[], ''],
        ];
    }
}
