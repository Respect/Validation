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

use PHPUnit_Framework_TestCase;

/**
 * @covers Respect\Validation\Rules\SubdivisionCode
 * @covers Respect\Validation\Exceptions\SubdivisionCodeException
 */
class SubdivisionCodeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid entry for ISO 3166-2
     */
    public function testShouldThrowsExceptionWhenInvalidFormat()
    {
        new SubdivisionCode('whatever');
    }

    /**
     * @expectedException        Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "JK" is not a valid entry for ISO 3166-2
     */
    public function testShouldNotAcceptWrongNamesOnConstructor()
    {
        new SubdivisionCode('JK');
    }

    public function testShouldDefineASubdivisionCodeFormatOnConstructor()
    {
        $countrySubdivision = new SubdivisionCode('US');

        $this->assertEquals('US', $countrySubdivision->entry);
    }

    public function providerForValidSubdivisionCodeInformation()
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
     * @dataProvider providerForValidSubdivisionCodeInformation
     */
    public function testShouldValidateValidSubdivisionCodeInformation($entry, $input)
    {
        $countrySubdivision = new SubdivisionCode($entry);

        $this->assertTrue($countrySubdivision->validate($input));
    }

    public function providerForInvalidSubdivisionCodeInformation()
    {
        return array(
            array('BR',  'CA'),
            array('MV',  0),
            array('US',  'CE'),
        );
    }

    /**
     * @dataProvider providerForInvalidSubdivisionCodeInformation
     */
    public function testShouldNotValidateInvalidSubdivisionCodeInformation($entry, $input)
    {
        $countrySubdivision = new SubdivisionCode($entry);

        $this->assertFalse($countrySubdivision->validate($input));
    }

    /**
     * @expectedException        Respect\Validation\Exceptions\SubdivisionCode\BrSubdivisionCodeException
     * @expectedExceptionMessage "CA" must be a country subdivision of Brazil
     */
    public function testShouldThrowsSubdivisionCodeException()
    {
        $countrySubdivision = new SubdivisionCode('BR');
        $countrySubdivision->assert('CA');
    }
}
