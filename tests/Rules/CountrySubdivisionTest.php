<?php

namespace Respect\Validation\Rules;

use PHPUnit_Framework_TestCase;

/**
 * @covers Respect\Validation\Rules\CountrySubdivision
 * @covers Respect\Validation\Exceptions\CountrySubdivisionException
 */
class CountrySubdivisionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid entry for ISO 3166-2
     */
    public function testShouldThrowsExceptionWhenInvalidFormat()
    {
        new CountrySubdivision('whatever');
    }

    /**
     * @expectedException        Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "JK" is not a valid entry for ISO 3166-2
     */
    public function testShouldNotAcceptWrongNamesOnConstructor()
    {
        new CountrySubdivision('JK');
    }

    public function testShouldDefineACountrySubdivisionFormatOnConstructor()
    {
        $countrySubdivision = new CountrySubdivision('US');

        $this->assertEquals('US', $countrySubdivision->entry);
    }

    public function providerForValidCountrySubdivisionInformation()
    {
        return array(
            array('AQ',  null),
            array('BR',  'SP'),
            array('MV',  '00'),
            array('US',  'CA'),
            array('YT',  ''),
        );
    }

    /**
     * @dataProvider providerForValidCountrySubdivisionInformation
     */
    public function testShouldValidateValidCountrySubdivisionInformation($entry, $input)
    {
        $countrySubdivision = new CountrySubdivision($entry);

        $this->assertTrue($countrySubdivision->validate($input));
    }

    public function providerForInvalidCountrySubdivisionInformation()
    {
        return array(
            array('BR',  'CA'),
            array('MV',  0),
            array('US',  'CE'),
        );
    }

    /**
     * @dataProvider providerForInvalidCountrySubdivisionInformation
     */
    public function testShouldNotValidateInvalidCountrySubdivisionInformation($entry, $input)
    {
        $countrySubdivision = new CountrySubdivision($entry);

        $this->assertFalse($countrySubdivision->validate($input));
    }

    /**
     * @expectedException        Respect\Validation\Exceptions\CountrySubdivisionException
     * @expectedExceptionMessage "CA" must be a country subdivision of Brazil
     */
    public function testShouldThrowsCountrySubdivisionException()
    {
        $countrySubdivision = new CountrySubdivision('BR');
        $countrySubdivision->assert('CA');
    }
}
