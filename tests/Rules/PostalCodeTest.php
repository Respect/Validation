<?php
namespace Respect\Validation\Rules;

class PostalCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldUsePatternAccordingToLocale()
    {
        $locale = 'BR';

        $rule = new PostalCode($locale);

        $actualPattern = $rule->regex;
        $expectedPattern = $rule->postalCodes[$locale];

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate postal code from "Whatever" country
     */
    public function testShouldThrowsExceptionWhenCannotFindLocalePattern()
    {
        new PostalCode('Whatever');
    }

    /**
     * @dataProvider validPostalCodesProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($locale, $postalCode)
    {
        $rule = new PostalCode($locale);

        $this->assertTrue($rule->validate($postalCode));
    }

    public function validPostalCodesProvider()
    {
        return array(
            array('BR', '02179000'),
            array('BR', '02179-000'),
            array('US', '02179'),
        );
    }

    /**
     * @dataProvider invalidPostalCodesProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($locale, $postalCode)
    {
        $rule = new PostalCode($locale);

        $this->assertFalse($rule->validate($postalCode));
    }

    public function invalidPostalCodesProvider()
    {
        return array(
            array('BR', '02179'),
            array('BR', '02179.000'),
            array('US', '021 79'),
        );
    }
}
