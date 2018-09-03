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
 * @covers \Respect\Validation\Exceptions\VowelException
 * @covers \Respect\Validation\Rules\Vowel
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
        self::assertTrue($validator->isValid($validVowels));
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
        self::assertFalse($validator->isValid($invalidVowels));
        $validator->assert($invalidVowels);
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        $validator = new Vowel($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Vowel($additional);
        self::assertTrue($validator->isValid($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} aeo iu'],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n aeo iu"],
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
