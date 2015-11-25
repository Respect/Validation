<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\PostalCode
 */
class PostalCodeTest extends \PHPUnit_Framework_TestCase
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
        return array(
            array('BR', '02179-000'),
            array('BR', '02179000'),
            array('GB', 'GIR 0AA'),
            array('GB', 'PR1 9LY'),
            array('US', '02179'),
            array('YE', ''),
            array('PL', '99-300'),
        );
    }

    /**
     * @dataProvider invalidPostalCodesProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode)
    {
        $rule = new PostalCode($countryCode);

        $this->assertFalse($rule->validate($postalCode));
    }

    public function invalidPostalCodesProvider()
    {
        return array(
            array('BR', '02179'),
            array('BR', '02179.000'),
            array('GB', 'GIR 00A'),
            array('GB', 'GIR0AA'),
            array('GB', 'PR19LY'),
            array('US', '021 79'),
            array('YE', '02179'),
            array('PL', '99300'),
        );
    }
}
