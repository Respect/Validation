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
 * @covers Respect\Validation\Rules\Space
 * @covers Respect\Validation\Exceptions\SpaceException
 */
class SpaceTest extends TestCase
{
    /**
     * @dataProvider providerForValidSpace
     */
    public function testValidDataWithSpaceShouldReturnTrue($validSpace, $additional = '')
    {
        $validator = new Space($additional);
        $this->assertTrue($validator->validate($validSpace));
    }

    /**
     * @dataProvider providerForInvalidSpace
     * @expectedException Respect\Validation\Exceptions\SpaceException
     */
    public function testInvalidSpaceShouldFailAndThrowSpaceException($invalidSpace, $additional = '')
    {
        $validator = new Space($additional);
        $this->assertFalse($validator->validate($invalidSpace));
        $this->assertFalse($validator->assert($invalidSpace));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Space($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Space($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} '],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n "],
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

    public function providerForValidSpace()
    {
        return [
            ["\n"],
            [' '],
            ['    '],
            ["\t"],
            ['	'],
        ];
    }

    public function providerForInvalidSpace()
    {
        return [
            [''],
            ['16-50'],
            ['a'],
            ['Foo'],
            ['12.1'],
            ['-12'],
            [-12],
            ['_'],
        ];
    }
}
