<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Cntrl
 * @covers \Respect\Validation\Exceptions\CntrlException
 */
class CntrlTest extends TestCase
{
    /**
     * @dataProvider providerForValidCntrl
     */
    public function testValidDataWithCntrlShouldReturnTrue($validCntrl, $additional = ''): void
    {
        $validator = new Cntrl($additional);
        self::assertTrue($validator->validate($validCntrl));
    }

    /**
     * @dataProvider providerForInvalidCntrl
     * @expectedException \Respect\Validation\Exceptions\CntrlException
     */
    public function testInvalidCntrlShouldFailAndThrowCntrlException($invalidCntrl, $additional = ''): void
    {
        $validator = new Cntrl($additional);
        self::assertFalse($validator->validate($invalidCntrl));
        self::assertFalse($validator->assert($invalidCntrl));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        $validator = new Cntrl($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Cntrl($additional);
        self::assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){} ', '!@#$%^&*(){} '],
            ['[]?+=/\\-_|"\',<>. ', "[]?+=/\\-_|\"',<>. \t \n"],
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

    public function providerForValidCntrl()
    {
        return [
            ["\n"],
            ["\r"],
            ["\t"],
            ["\n\r\t"],
//            array("\n \n", ' '), TODO Verify this
        ];
    }

    public function providerForInvalidCntrl()
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
            ['alganet'],
        ];
    }
}
