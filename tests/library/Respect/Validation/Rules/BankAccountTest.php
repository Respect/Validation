<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\BankAccount
 */
class BankAccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate bank account for country "xx"
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        new BankAccount('xx', 'bank');
    }

    public function testCountryCodeIsCaseUnsensitive()
    {
        $rule1 = new BankAccount('de', 'bank');
        $rule2 = new BankAccount('DE', 'bank');

        $this->assertSame($rule1->validate('foo'), $rule2->validate('foo'));
    }

    /**
     * @dataProvider providerForBankAccount
     */
    public function testValidAccountShouldReturnTrue($countryCode, $bank, $account)
    {
        $rule = new BankAccount($countryCode, $bank);

        $this->assertTrue($rule->validate($account));
    }

    /**
     * @dataProvider providerForNotBankAccount
     * @expectedException Respect\Validation\Exceptions\BankAccountException
     * @expectedExceptionMessageRegExp /^"[^"]+" must be a bank account$/
     */
    public function testInvalidAccountShouldRaiseException($countryCode, $bank, $account)
    {
        $rule = new BankAccount($countryCode, $bank);
        $rule->check($account);
    }

    /**
     * @dataProvider providerForNotBankAccount
     */
    public function testInvalidAccountShouldReturnFalse($countryCode, $bank, $account)
    {
        $rule = new BankAccount($countryCode, $bank);

        $this->assertFalse($rule->validate($account));
    }

    public function providerForBankAccount()
    {
        return array(
            array('de', '70169464', '1112'),
            array('de', '70169464', '67067'),
        );
    }

    public function providerForNotBankAccount()
    {
        return array(
            array('de', '70169464', '1234'),
            array('de', '1234', '1234'),
        );
    }
}
