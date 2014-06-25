<?php
namespace Respect\Validation\Rules;

class GermanBankTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        new Bank("xx");
    }
    
    public function testCountryCodeIsCaseUnsensitive()
    {
        $validator1 = new Bank("de");
        $validator1->validate("foo");
        
        $validator2 = new Bank("DE");
        $validator2->validate("foo");
    }
    
    /**
     * @dataProvider providerForBank
     */
    public function testValidBankShouldReturnTrue(Bank $validator, $bank)
    {
        $this->assertTrue($validator->__invoke($bank));
        $this->assertTrue($validator->assert($bank));
        $this->assertTrue($validator->check($bank));
    }

    /**
     * @dataProvider providerForNotBank
     * @expectedException Respect\Validation\Exceptions\BankException
     */
    public function testInvalidBankShouldRaiseException(Bank $validator, $bank)
    {
        $this->assertFalse($validator->check($bank));
    }

    /**
     * @dataProvider providerForNotBank
     */
    public function testInvalidBankShouldReturnFalse(Bank $validator, $bank)
    {
        $this->assertFalse($validator->__invoke($bank));
    }
    
    public function providerForNotBank()
    {
        return array(
            array(new Bank("de"), "1234")
        );
    }
    
    public function providerForBank()
    {
        return array(
            array(new Bank("de"), "10000000")
        );
    }
}

