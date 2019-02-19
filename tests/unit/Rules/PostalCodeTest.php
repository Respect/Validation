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
 * @group  rule
 * @covers Respect\Validation\Rules\PostalCode
 * @covers Respect\Validation\Exceptions\PostalCodeException
 */
class PostalCodeTest extends TestCase
{
    public function testShouldUsePatternAccordingToCountryCode()
    {
        $countryCode = 'BR';

        $rule = new PostalCode($countryCode);

        $actualPattern = $rule->regex;
        $expectedPattern = $rule->postalCodes[$countryCode];

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldNotBeCaseSensitiveWhenChoosingPatternAccordingToCountryCode()
    {
        $rule1 = new PostalCode('BR');
        $rule2 = new PostalCode('br');

        $this->assertEquals($rule1->regex, $rule2->regex);
    }

    public function testShouldUseDefaultPatternWhenCountryCodeDoesNotHavePostalCode()
    {
        $rule = new PostalCode('ZW');

        $actualPattern = $rule->regex;
        $expectedPattern = PostalCode::DEFAULT_PATTERN;

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldValidateEmptyStringsWhenUsingDefaultPattern()
    {
        $rule = new PostalCode('ZW');

        $this->assertTrue($rule->validate(''));
    }

    public function testShouldNotValidateNonEmptyStringsWhenUsingDefaultPattern()
    {
        $rule = new PostalCode('ZW');

        $this->assertFalse($rule->validate(' '));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate postal code from "Whatever" country
     */
    public function testShouldThrowsExceptionWhenCountryCodeIsNotValid()
    {
        new PostalCode('Whatever');
    }

    /**
     * @dataProvider validPostalCodesProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode)
    {
        $rule = new PostalCode($countryCode);

        $this->assertTrue($rule->validate($postalCode));
    }

    public function validPostalCodesProvider()
    {
        return [
            ['BR', '02179-000'],
            ['BR', '02179000'],
            ['CA', 'A1A 2B2'],
            ['GB', 'GIR 0AA'],
            ['GB', 'PR1 9LY'],
            ['US', '02179'],
            ['YE', ''],
            ['PL', '99-300'],
            ['NL', '1012 GX'],
            ['NL', '1012GX'],
            ['PT', '3660-606'],
            ['PT', '3660606'],
            ['CO', '110231'],
            ['KR', '03187'],
            ['IE', 'D14 YD91'],
            ['IE', 'D6W 3333'],
        ];
    }

    /**
     * @dataProvider invalidPostalCodesProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode)
    {
        $rule = new PostalCode($countryCode);

        $this->assertFalse($rule->validate($postalCode));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\PostalCodeException
     * @expectedExceptionMessage "02179-000" must be a valid postal code on "US"
     */
    public function testShouldThrowsPostalCodeExceptionWhenValidationFails()
    {
        $rule = new PostalCode('US');
        $rule->check('02179-000');
    }

    public function invalidPostalCodesProvider()
    {
        return [
            ['BR', '02179'],
            ['BR', '02179.000'],
            ['CA', '1A1B2B'],
            ['GB', 'GIR 00A'],
            ['GB', 'GIR0AA'],
            ['GB', 'PR19LY'],
            ['US', '021 79'],
            ['YE', '02179'],
            ['PL', '99300'],
            ['KR', '548940'],
            ['KR', '548-940'],
        ];
    }
}
