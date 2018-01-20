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
 * @covers \Respect\Validation\Rules\Lowercase
 * @covers \Respect\Validation\Exceptions\LowercaseException
 */
class LowercaseTest extends TestCase
{
    /**
     * @dataProvider providerForValidLowercase
     */
    public function testValidLowercaseShouldReturnTrue($input): void
    {
        $lowercase = new Lowercase();
        self::assertTrue($lowercase->__invoke($input));
        self::assertTrue($lowercase->assert($input));
        self::assertTrue($lowercase->check($input));
    }

    /**
     * @dataProvider providerForInvalidLowercase
     * @expectedException \Respect\Validation\Exceptions\LowercaseException
     */
    public function testInvalidLowercaseShouldThrowException($input): void
    {
        $lowercase = new Lowercase();
        self::assertFalse($lowercase->__invoke($input));
        self::assertFalse($lowercase->assert($input));
    }

    public function providerForValidLowercase()
    {
        return [
            [''],
            ['lowercase'],
            ['lowercase-with-dashes'],
            ['lowercase with spaces'],
            ['lowercase with numbers 123'],
            ['lowercase with specials characters like ã ç ê'],
            ['with specials characters like # $ % & * +'],
            ['τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός'],
        ];
    }

    public function providerForInvalidLowercase()
    {
        return [
            ['UPPERCASE'],
            ['CamelCase'],
            ['First Character Uppercase'],
            ['With Numbers 1 2 3'],
        ];
    }
}
