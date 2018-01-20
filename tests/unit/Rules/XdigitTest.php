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
 * @covers \Respect\Validation\Rules\Xdigit
 * @covers \Respect\Validation\Exceptions\XdigitException
 */
class XdigitTest extends TestCase
{
    protected $xdigitsValidator;

    protected function setUp(): void
    {
        $this->xdigitsValidator = new Xdigit();
    }

    /**
     * @dataProvider providerForXdigit
     */
    public function testValidateValidHexasdecimalDigits($input): void
    {
        self::assertTrue($this->xdigitsValidator->assert($input));
        self::assertTrue($this->xdigitsValidator->check($input));
        self::assertTrue($this->xdigitsValidator->validate($input));
    }

    /**
     * @dataProvider providerForNotXdigit
     * @expectedException \Respect\Validation\Exceptions\XdigitException
     */
    public function testInvalidHexadecimalDigitsShouldThrowXdigitException($input): void
    {
        self::assertFalse($this->xdigitsValidator->validate($input));
        self::assertFalse($this->xdigitsValidator->assert($input));
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Xdigit($additional);
        self::assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ['!@#$%^&*(){} ', '!@#$%^&*(){} abc 123'],
            ["[]?+=/\\-_|\"',<>. \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    public function providerForXdigit()
    {
        return [
            ['FFF'],
            ['15'],
            ['DE12FA'],
            ['1234567890abcdef'],
            [0x123],
        ];
    }

    public function providerForNotXdigit()
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
