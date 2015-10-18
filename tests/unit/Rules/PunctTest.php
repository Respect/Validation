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
 * @covers Respect\Validation\Rules\Punct
 * @covers Respect\Validation\Exceptions\PunctException
 */
class PunctTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidPunct
     */
    public function testValidDataWithPunctShouldReturnTrue($validPunct, $additional = '')
    {
        $validator = new Punct($additional);
        $this->assertTrue($validator->validate($validPunct));
    }

    /**
     * @dataProvider providerForInvalidPunct
     * @expectedException Respect\Validation\Exceptions\PunctException
     */
    public function testInvalidPunctShouldFailAndThrowPunctException($invalidPunct, $additional = '')
    {
        $validator = new Punct($additional);
        $this->assertFalse($validator->validate($invalidPunct));
        $this->assertFalse($validator->assert($invalidPunct));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Punct($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Punct($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['abc123 ', '!@#$%^&*(){} abc 123'],
            ["abc123 \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"],
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

    public function providerForValidPunct()
    {
        return [
            ['.'],
            [',;:'],
            ['-@#$*'],
            ['()[]{}'],
        ];
    }

    public function providerForInvalidPunct()
    {
        return [
            [''],
            ['16-50'],
            ['a'],
            [' '],
            ['Foo'],
            ['12.1'],
            ['-12'],
            [-12],
            ['( )_{}'],
        ];
    }
}
