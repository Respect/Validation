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
 * @covers \Respect\Validation\Exceptions\VowelException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Vowel
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
class VowelTest extends TestCase
{
    /**
     * @dataProvider providerForValidVowels
     *
     * @test
     */
    public function validDataWithVowelsShouldReturnTrue($validVowels, $additional = ''): void
    {
        $validator = new Vowel($additional);
        self::assertTrue($validator->validate($validVowels));
    }

    /**
     * @dataProvider providerForInvalidVowels
     * @expectedException \Respect\Validation\Exceptions\VowelException
     *
     * @test
     */
    public function invalidVowelsShouldFailAndThrowVowelException($invalidVowels, $additional = ''): void
    {
        $validator = new Vowel($additional);
        self::assertFalse($validator->validate($invalidVowels));
        $validator->assert($invalidVowels);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Vowel($additional);
        self::assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} aeo iu'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n aeo iu"],
        ];
    }

    public function providerForValidVowels()
    {
        return [
            ['a'],
            ['e'],
            ['i'],
            ['o'],
            ['u'],
            ['aeiou'],
            ['aei ou'],
            ["\na\t"],
            ['uoiea'],
        ];
    }

    public function providerForInvalidVowels()
    {
        return [
            [''],
            [null],
            ['16'],
            ['F'],
            ['g'],
            ['Foo'],
            [-50],
            ['basic'],
        ];
    }
}
