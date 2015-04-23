<?php

namespace Respect\Validation\Rules;

use PHPUnit_Framework_TestCase;

/**
 * @covers Respect\Validation\Rules\Country
 * @covers Respect\Validation\Exceptions\CountryException
 */
class CountryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid country set
     */
    public function testShouldThrowsExceptionWhenInvalidFormat()
    {
        new Country('whatever');
    }

    public function testShouldUseISO3166Alpha2ByDefault()
    {
        $country = new Country();

        $this->assertEquals(Country::ALPHA2, $country->set);
    }

    public function testShouldDefineACountryFormatOnConstructor()
    {
        $country = new Country(Country::NUMERIC);

        $this->assertEquals(Country::NUMERIC, $country->set);
    }

    public function providerForValidCountryInformation()
    {
        return array(
            array(Country::ALPHA2,  'US'),
            array(Country::ALPHA3,  'USA'),
            array(Country::NUMERIC, '840'),
        );
    }

    /**
     * @dataProvider providerForValidCountryInformation
     */
    public function testShouldValidateValidCountryInformation($format, $input)
    {
        $country = new Country($format);

        $this->assertTrue($country->validate($input));
    }

    public function providerForInvalidCountryInformation()
    {
        return array(
            array(Country::ALPHA2,  'USA'),
            array(Country::ALPHA3,  'US'),
            array(Country::NUMERIC, '000'),
        );
    }

    /**
     * @dataProvider providerForInvalidCountryInformation
     */
    public function testShouldNotValidateInvalidCountryInformation($format, $input)
    {
        $country = new Country($format);

        $this->assertFalse($country->validate($input));
    }

    /**
     * @expectedException        Respect\Validation\Exceptions\CountryException
     * @expectedExceptionMessage "whatever" must be a country in ISO 3166-1 alpha-2
     */
    public function testShouldThrowsCountryException()
    {
        $country = new Country();
        $country->assert('whatever');
    }
}
