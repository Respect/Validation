<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\CountryCode
 */
class CountryCodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid country set
     */
    public function testShouldThrowsExceptionWhenInvalidFormat()
    {
        new CountryCode('whatever');
    }

    public function testShouldUseISO3166Alpha2ByDefault()
    {
        $country = new CountryCode();
        $this->assertEquals(CountryCode::ALPHA2, $country->set);
    }
    public function testShouldDefineACountryFormatOnConstructor()
    {
        $country = new CountryCode(CountryCode::NUMERIC);
        $this->assertEquals(CountryCode::NUMERIC, $country->set);
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
    public function testValidContryCodes($format, $input)
    {
        $rule = new CountryCode($format);

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForInvalidCountryCode
     */
    public function testInvalidContryCodes($format, $input)
    {
        $rule = new CountryCode($format);

        $this->assertFalse($rule->validate($input));
    }
}
