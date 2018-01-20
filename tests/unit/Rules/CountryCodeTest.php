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
 * @covers \Respect\Validation\Rules\CountryCode
 */
class CountryCodeTest extends TestCase
{
    /**
     * @expectedException        \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid country set
     */
    public function testShouldThrowsExceptionWhenInvalidFormat(): void
    {
        new CountryCode('whatever');
    }

    public function testShouldUseISO3166Alpha2ByDefault(): void
    {
        $country = new CountryCode();
        self::assertEquals(CountryCode::ALPHA2, $country->set);
    }

    public function testShouldDefineACountryFormatOnConstructor(): void
    {
        $country = new CountryCode(CountryCode::NUMERIC);
        self::assertEquals(CountryCode::NUMERIC, $country->set);
    }

    public function providerForValidCountryCode()
    {
        return [
            [CountryCode::ALPHA2,  'BR'],
            [CountryCode::ALPHA3,  'BRA'],
            [CountryCode::NUMERIC, '076'],
            [CountryCode::ALPHA2,  'DE'],
            [CountryCode::ALPHA3,  'DEU'],
            [CountryCode::NUMERIC, '276'],
            [CountryCode::ALPHA2,  'US'],
            [CountryCode::ALPHA3,  'USA'],
            [CountryCode::NUMERIC, '840'],
        ];
    }

    public function providerForInvalidCountryCode()
    {
        return [
            [CountryCode::ALPHA2,  'USA'],
            [CountryCode::ALPHA3,  'US'],
            [CountryCode::NUMERIC, '000'],
        ];
    }

    /**
     * @dataProvider providerForValidCountryCode
     */
    public function testValidContryCodes($format, $input): void
    {
        $rule = new CountryCode($format);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForInvalidCountryCode
     */
    public function testInvalidContryCodes($format, $input): void
    {
        $rule = new CountryCode($format);

        self::assertFalse($rule->validate($input));
    }
}
