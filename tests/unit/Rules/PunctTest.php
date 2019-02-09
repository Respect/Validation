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
 * @covers \Respect\Validation\Exceptions\PunctException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Punct
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class PunctTest extends TestCase
{
    /**
     * @dataProvider providerForValidPunct
     *
     * @test
     */
    public function validDataWithPunctShouldReturnTrue(string $validPunct): void
    {
        $validator = new Punct();
        self::assertTrue($validator->validate($validPunct));
    }

    /**
     * @dataProvider providerForInvalidPunct
     * @expectedException \Respect\Validation\Exceptions\PunctException
     *
     * @test
     *
     * @param mixed $invalidPunct
     */
    public function invalidPunctShouldFailAndThrowPunctException($invalidPunct): void
    {
        $validator = new Punct();
        self::assertFalse($validator->validate($invalidPunct));
        $validator->assert($invalidPunct);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected(string $additional, string $input): void
    {
        $validator = new Punct($additional);
        self::assertTrue($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerAdditionalChars(): array
    {
        return [
            ['abc123 ', '!@#$%^&*(){} abc 123'],
            ["abc123 \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForValidPunct(): array
    {
        return [
            ['.'],
            [',;:'],
            ['-@#$*'],
            ['()[]{}'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidPunct(): array
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
