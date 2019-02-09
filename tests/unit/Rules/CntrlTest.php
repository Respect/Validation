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
 * @covers \Respect\Validation\Exceptions\CntrlException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Cntrl
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class CntrlTest extends TestCase
{
    /**
     * @dataProvider providerForValidCntrl
     *
     * @test
     */
    public function validDataWithCntrlShouldReturnTrue(string $input): void
    {
        $validator = new Cntrl();
        self::assertTrue($validator->validate($input));
    }

    /**
     * @dataProvider providerForInvalidCntrl
     * @expectedException \Respect\Validation\Exceptions\CntrlException
     *
     * @test
     *
     * @param mixed $input
     */
    public function invalidCntrlShouldFailAndThrowCntrlException($input): void
    {
        $validator = new Cntrl();
        self::assertFalse($validator->validate($input));
        $validator->assert($input);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected(string $additional, string $input): void
    {
        $validator = new Cntrl($additional);
        self::assertTrue($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerAdditionalChars(): array
    {
        return [
            ['!@#$%^&*(){} ', '!@#$%^&*(){} '],
            ['[]?+=/\\-_|"\',<>. ', "[]?+=/\\-_|\"',<>. \t \n"],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForValidCntrl(): array
    {
        return [
            ["\n"],
            ["\r"],
            ["\t"],
            ["\n\r\t"],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidCntrl(): array
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
