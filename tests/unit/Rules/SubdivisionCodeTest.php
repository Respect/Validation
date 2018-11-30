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

use Respect\Validation\TestCase;

/**
 * @covers Respect\Validation\Rules\SubdivisionCode
 * @covers Respect\Validation\Exceptions\SubdivisionCodeException
 */
class SubdivisionCodeTest extends TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid country code in ISO 3166-2
     */
    public function testShouldThrowsExceptionWhenInvalidFormat()
    {
        new SubdivisionCode('whatever');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "JK" is not a valid country code in ISO 3166-2
     */
    public function testShouldNotAcceptWrongNamesOnConstructor()
    {
        new SubdivisionCode('JK');
    }

    public function testShouldDefineASubdivisionCodeFormatOnConstructor()
    {
        $countrySubdivision = new SubdivisionCode('US');

        $this->assertEquals('US', $countrySubdivision->countryCode);
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
     */
    public function testShouldValidateValidSubdivisionCodeInformation($countryCode, $input)
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        $this->assertTrue($countrySubdivision->validate($input));
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
     */
    public function testShouldNotValidateInvalidSubdivisionCodeInformation($countryCode, $input)
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        $this->assertFalse($countrySubdivision->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\SubdivisionCode\BrSubdivisionCodeException
     * @expectedExceptionMessage "CA" must be a subdivision code of Brazil
     */
    public function testShouldThrowsSubdivisionCodeException()
    {
        $countrySubdivision = new SubdivisionCode('BR');
        $countrySubdivision->assert('CA');
    }
}
