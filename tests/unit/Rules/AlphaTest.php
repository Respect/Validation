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
 * @covers \Respect\Validation\Exceptions\AlphaException
 * @covers \Respect\Validation\Rules\Alpha
 */
class AlphaTest extends TestCase
{
    /**
     * @dataProvider providerForValidAlpha
     *
     * @test
     */
    public function validAlphanumericCharsShouldReturnTrue($validAlpha, $additional): void
    {
        $validator = new Alpha($additional);
        self::assertTrue($validator->isValid($validAlpha));
        $validator->check($validAlpha);
        $validator->assert($validAlpha);
    }

    /**
     * @dataProvider providerForInvalidAlpha
     * @expectedException \Respect\Validation\Exceptions\AlphaException
     *
     * @test
     */
    public function invalidAlphanumericCharsShouldThrowAlphaException($invalidAlpha, $additional): void
    {
        $validator = new Alpha($additional);
        self::assertFalse($validator->isValid($invalidAlpha));
        $validator->assert($invalidAlpha);
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentException($additional): void
    {
        $validator = new Alpha($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Alpha($additional);
        self::assertTrue($validator->isValid($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} abc'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n abc"],
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

    public function providerForValidAlpha()
    {
        return [
            ['alganet', ''],
            ['alganet', 'alganet'],
            ['0alg-anet0', '0-9'],
            ['a', ''],
            ["\t", ''],
            ["\n", ''],
            ['foobar', ''],
            ['rubinho_', '_'],
            ['google.com', '.'],
            ['alganet alganet', ''],
            ["\nabc", ''],
            ["\tdef", ''],
            ["\nabc \t", ''],
        ];
    }

    public function providerForInvalidAlpha()
    {
        return [
            ['', ''],
            ['@#$', ''],
            ['_', ''],
            ['dgç', ''],
            ['122al', ''],
            ['122', ''],
            [11123, ''],
            [1e21, ''],
            [0, ''],
            [null, ''],
            [new \stdClass(), ''],
            [[], ''],
        ];
    }
}
