<?php
namespace Respect\Validation\Rules;

class BankAccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        $validator = new BankAccount("xx", "bank");
    }
    
    public function testCountryCodeIsCaseUnsensitive()
    {
        $validator1 = new BankAccount("de", "bank");
        $validator1->validate("foo");
        
        $validator2 = new BankAccount("DE", "bank");
        $validator2->validate("foo");
    }
    
    /**
     * @dataProvider providerForBankAccount
     */
    public function testValidAccountShouldReturnTrue(BankAccount $validator, $account)
    {
        $this->assertTrue($validator->__invoke($account));
        $this->assertTrue($validator->assert($account));
        $this->assertTrue($validator->check($account));
    }

    /**
     * @dataProvider providerForNotBankAccount
     * @expectedException Respect\Validation\Exceptions\BankAccountException
     */
    public function testInvalidAccountShouldRaiseException(BankAccount $validator, $account)
    {
        $this->assertFalse($validator->check($account));
    }

    /**
     * @dataProvider providerForNotBankAccount
     */
    public function testInvalidAccountShouldReturnFalse(BankAccount $validator, $account)
    {
        $this->assertFalse($validator->__invoke($account));
    }
    
    public function providerForBankAccount()
    {
        return array(
            array(new BankAccount("de", "70169464"), "1112"),
            array(new BankAccount("de", "70169464"), "67067"),
        );
    }
    
    public function providerForNotBankAccount()
    {
        return array(
            array(new BankAccount("de", "70169464"), "1234"),
            array(new BankAccount("de", "1234"), "1234")
        );
    }
}

