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
 * @covers \Respect\Validation\Rules\Uppercase
 * @covers \Respect\Validation\Exceptions\UppercaseException
 */
class UppercaseTest extends TestCase
{
    /**
     * @dataProvider providerForValidUppercase
     */
    public function testValidUppercaseShouldReturnTrue($input): void
    {
        $uppercase = new Uppercase();
        self::assertTrue($uppercase->validate($input));
        self::assertTrue($uppercase->assert($input));
        self::assertTrue($uppercase->check($input));
    }

    /**
     * @dataProvider providerForInvalidUppercase
     * @expectedException \Respect\Validation\Exceptions\UppercaseException
     */
    public function testInvalidUppercaseShouldThrowException($input): void
    {
        $lowercase = new Uppercase();
        self::assertFalse($lowercase->validate($input));
        self::assertFalse($lowercase->assert($input));
    }

    public function providerForValidUppercase()
    {
        return [
            [''],
            ['UPPERCASE'],
            ['UPPERCASE-WITH-DASHES'],
            ['UPPERCASE WITH SPACES'],
            ['UPPERCASE WITH NUMBERS 123'],
            ['UPPERCASE WITH SPECIALS CHARACTERS LIKE Ã Ç Ê'],
            ['WITH SPECIALS CHARACTERS LIKE # $ % & * +'],
            ['ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ'],
        ];
    }

    public function providerForInvalidUppercase()
    {
        return [
            ['lowercase'],
            ['CamelCase'],
            ['First Character Uppercase'],
            ['With Numbers 1 2 3'],
        ];
    }
}
