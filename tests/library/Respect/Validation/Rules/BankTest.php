<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\Bank
 */
class BankTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldUseDefinedFactoryToCreateInternalRuleBasedOnGivenCountryCode()
    {
        $countryCode    = 'XX';

        $validatable    = $this->getMock('Respect\Validation\Validatable');
        $factory        = $this->getMock('Respect\Validation\Rules\Locale\Factory');
        $factory
            ->expects($this->once())
            ->method('bank')
            ->with($countryCode)
            ->will($this->returnValue($validatable));

        $rule           = new Bank($countryCode, $factory);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldUseDefaultFactoryToCreateInternalRuleBasedOnGivenCountryCodeWhenFactoryIsNotDefined()
    {
        $countryCode    = 'DE';
        $rule           = new Bank($countryCode);

        $this->assertInstanceOf('Respect\Validation\Rules\Locale\GermanBank', $rule->getValidatable());
    }
}
