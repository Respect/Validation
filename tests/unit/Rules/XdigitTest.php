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
 * @covers \Respect\Validation\Exceptions\XdigitException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Xdigit
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class XdigitTest extends TestCase
{
    /**
     * @var Xdigit
     */
    protected $xdigitsValidator;

    protected function setUp(): void
    {
        $this->xdigitsValidator = new Xdigit();
    }

    /**
     * @dataProvider providerForXdigit
     *
     * @test
     *
     * @param mixed $input
     */
    public function validateValidHexasdecimalDigits($input): void
    {
        $this->xdigitsValidator->assert($input);
        $this->xdigitsValidator->check($input);
        self::assertTrue($this->xdigitsValidator->validate($input));
    }

    /**
     * @dataProvider providerForNotXdigit
     * @expectedException \Respect\Validation\Exceptions\XdigitException
     *
     * @test
     *
     * @param mixed $input
     */
    public function invalidHexadecimalDigitsShouldThrowXdigitException($input): void
    {
        self::assertFalse($this->xdigitsValidator->validate($input));
        $this->xdigitsValidator->assert($input);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected(string $additional, string $input): void
    {
        $validator = new Xdigit($additional);
        self::assertTrue($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerAdditionalChars(): array
    {
        return [
            ['!@#$%^&*(){} ', '!@#$%^&*(){} abc 123'],
            ["[]?+=/\\-_|\"',<>. \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForXdigit(): array
    {
        return [
            ['FFF'],
            ['15'],
            ['DE12FA'],
            ['1234567890abcdef'],
            [0x123],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForNotXdigit(): array
    {
        return [
            [''],
            [null],
            ['j'],
            [' '],
            ['Foo'],
            ['1.5'],
        ];
    }
}
