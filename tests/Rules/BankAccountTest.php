<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Test\LocaleTestCase;

/**
 * @covers Respect\Validation\Rules\BankAccount
 */
class BankAccountTest extends LocaleTestCase
{
    public function testShouldUseDefinedFactoryToCreateInternalRuleBasedOnGivenCountryCode()
    {
        $countryCode    = 'XX';
        $bank           = '123456';

        $validatable    = $this->getMock('Respect\Validation\Validatable');
        $factory        = $this->getMock('Respect\Validation\Rules\Locale\Factory');
        $factory
            ->expects($this->once())
            ->method('bankAccount')
            ->with($countryCode, $bank)
            ->will($this->returnValue($validatable));

        $rule           = new BankAccount($countryCode, $bank, $factory);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldUseDefaultFactoryToCreateInternalRuleBasedOnGivenCountryCodeWhenFactoryIsNotDefined()
    {
        $countryCode    = 'DE';
        $bank           = '123456';
        $rule           = new BankAccount($countryCode, $bank);

        $this->assertInstanceOf('Respect\Validation\Rules\Locale\GermanBankAccount', $rule->getValidatable());
    }
}
