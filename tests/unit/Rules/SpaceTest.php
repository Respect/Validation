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
 * @covers \Respect\Validation\Exceptions\SpaceException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Space
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class SpaceTest extends TestCase
{
    /**
     * @dataProvider providerForValidSpace
     *
     * @test
     */
    public function validDataWithSpaceShouldReturnTrue(string $validSpace): void
    {
        $validator = new Space();
        self::assertTrue($validator->validate($validSpace));
    }

    /**
     * @dataProvider providerForInvalidSpace
     * @expectedException \Respect\Validation\Exceptions\SpaceException
     *
     * @test
     *
     * @param mixed $invalidSpace
     */
    public function invalidSpaceShouldFailAndThrowSpaceException($invalidSpace): void
    {
        $validator = new Space();
        self::assertFalse($validator->validate($invalidSpace));
        $validator->assert($invalidSpace);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected(string $additional, string $input): void
    {
        $validator = new Space($additional);
        self::assertTrue($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerAdditionalChars(): array
    {
        return [
            ['!@#$%^&*(){}', '!@#$%^&*(){} '],
            ['[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n "],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForValidSpace(): array
    {
        return [
            ["\n"],
            [' '],
            ['    '],
            ["\t"],
            ['	'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidSpace(): array
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
