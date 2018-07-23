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
 * @covers \Respect\Validation\Exceptions\PunctException
 * @covers \Respect\Validation\Rules\Punct
 */
class PunctTest extends TestCase
{
    /**
     * @dataProvider providerForValidPunct
     *
     * @test
     */
    public function validDataWithPunctShouldReturnTrue($validPunct, $additional = ''): void
    {
        $validator = new Punct($additional);
        self::assertTrue($validator->validate($validPunct));
    }

    /**
     * @dataProvider providerForInvalidPunct
     * @expectedException \Respect\Validation\Exceptions\PunctException
     *
     * @test
     */
    public function invalidPunctShouldFailAndThrowPunctException($invalidPunct, $additional = ''): void
    {
        $validator = new Punct($additional);
        self::assertFalse($validator->validate($invalidPunct));
        $validator->assert($invalidPunct);
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        $validator = new Punct($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Punct($additional);
        self::assertTrue($validator->validate($query));
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
