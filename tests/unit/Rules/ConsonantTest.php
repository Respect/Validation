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
 * @covers \Respect\Validation\Exceptions\ConsonantException
 * @covers \Respect\Validation\Rules\Consonant
 */
class ConsonantTest extends TestCase
{
    /**
     * @dataProvider providerForValidConsonants
     *
     * @test
     */
    public function validDataWithConsonantsShouldReturnTrue($validConsonants, $additional = ''): void
    {
        $validator = new Consonant($additional);
        self::assertTrue($validator->validate($validConsonants));
    }

    /**
     * @dataProvider providerForInvalidConsonants
     * @expectedException \Respect\Validation\Exceptions\ConsonantException
     *
     * @test
     */
    public function invalidConsonantsShouldFailAndThrowConsonantException($invalidConsonants, $additional = ''): void
    {
        $validator = new Consonant($additional);
        self::assertFalse($validator->validate($invalidConsonants));
        $validator->assert($invalidConsonants);
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        $validator = new Consonant($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Consonant($additional);
        self::assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} bc dfg'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n bc dfg"],
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

    public function providerForValidConsonants()
    {
        return [
            ['b'],
            ['c'],
            ['d'],
            ['w'],
            ['y'],
            ['y', ''],
            ['bcdfghklmnp'],
            ['bcdfghklm np'],
            ['qrst'],
            ["\nz\t"],
            ['zbcxwyrspq'],
        ];
    }

    public function providerForInvalidConsonants()
    {
        return [
            [''],
            [null],
            ['16'],
            ['aeiou'],
            ['a'],
            ['Foo'],
            [-50],
            ['basic'],
        ];
    }
}
