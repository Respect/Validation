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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\ConsonantException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Consonant
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
class ConsonantTest extends TestCase
{
    /**
     * @dataProvider providerForValidConsonants
     *
     * @test
     */
    public function validDataWithConsonantsShouldReturnTrue(string $validConsonants): void
    {
        $validator = new Consonant();
        self::assertTrue($validator->validate($validConsonants));
    }

    /**
     * @dataProvider providerForInvalidConsonants
     * @expectedException \Respect\Validation\Exceptions\ConsonantException
     *
     * @test
     *
     * @param mixed $invalidConsonants
     */
    public function invalidConsonantsShouldFailAndThrowConsonantException($invalidConsonants): void
    {
        $validator = new Consonant();
        self::assertFalse($validator->validate($invalidConsonants));
        $validator->assert($invalidConsonants);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected(string $additional, string $input): void
    {
        $validator = new Consonant($additional);
        self::assertTrue($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerAdditionalChars(): array
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} bc dfg'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n bc dfg"],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForValidConsonants(): array
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

    /**
     * @return mixed[][]
     */
    public function providerForInvalidConsonants(): array
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
