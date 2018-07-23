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
 * @covers \Respect\Validation\Exceptions\SubdivisionCodeException
 * @covers \Respect\Validation\Rules\SubdivisionCode
 */
class SubdivisionCodeTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a supported country code
     *
     * @test
     */
    public function shouldThrowsExceptionWhenInvalidFormat(): void
    {
        new SubdivisionCode('whatever');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "JK" is not a supported country code
     *
     * @test
     */
    public function shouldNotAcceptWrongNamesOnConstructor(): void
    {
        new SubdivisionCode('JK');
    }

    /**
     * @test
     */
    public function shouldDefineASubdivisionCodeFormatOnConstructor(): void
    {
        $countryCode = 'US';
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertAttributeEquals($countryCode, 'countryCode', $countrySubdivision);
    }

    public function providerForValidSubdivisionCodeInformation()
    {
        return [
            ['AQ',  null],
            ['BR',  'SP'],
            ['MV',  '00'],
            ['US',  'CA'],
            ['YT',  ''],
        ];
    }

    /**
     * @dataProvider providerForValidSubdivisionCodeInformation
     *
     * @test
     */
    public function shouldValidateValidSubdivisionCodeInformation($countryCode, $input): void
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertTrue($countrySubdivision->validate($input));
    }

    public function providerForInvalidSubdivisionCodeInformation()
    {
        return [
            ['BR',  'CA'],
            ['MV',  0],
            ['US',  'CE'],
        ];
    }

    /**
     * @dataProvider providerForInvalidSubdivisionCodeInformation
     *
     * @test
     */
    public function shouldNotValidateInvalidSubdivisionCodeInformation($countryCode, $input): void
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertFalse($countrySubdivision->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\Locale\BrSubdivisionCodeException
     * @expectedExceptionMessage "CA" must be a subdivision code of Brazil
     *
     * @test
     */
    public function shouldThrowsSubdivisionCodeException(): void
    {
        $countrySubdivision = new SubdivisionCode('BR');
        $countrySubdivision->assert('CA');
    }
}
