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
class CntrlTest extends TestCase
{
    /**
     * @dataProvider providerForValidCntrl
     *
     * @test
     */
    public function validDataWithCntrlShouldReturnTrue($validCntrl, $additional = ''): void
    {
        $validator = new Cntrl($additional);
        self::assertTrue($validator->validate($validCntrl));
    }

    /**
     * @dataProvider providerForInvalidCntrl
     * @expectedException \Respect\Validation\Exceptions\CntrlException
     *
     * @test
     */
    public function invalidCntrlShouldFailAndThrowCntrlException($invalidCntrl, $additional = ''): void
    {
        $validator = new Cntrl($additional);
        self::assertFalse($validator->validate($invalidCntrl));
        $validator->assert($invalidCntrl);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
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
