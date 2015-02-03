<?php
namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Test\LocaleTestCase;

/**
 * @covers Respect\Validation\Rules\Locale\GermanBankAccount
 * @covers Respect\Validation\Exceptions\Locale\GermanBankAccountException
 */
class GermanBankAccountTest extends LocaleTestCase
{
    public function testShouldAcceptBankOnConstructor()
    {
        $bank = '10000000';
        $rule = new GermanBankAccount($bank);

        $this->assertSame($bank, $rule->bank);
    }

    public function testShouldAcceptBAVInstanceOnConstructor()
    {
        $bank = '10000000';
        $bav  = $this->getBavMock();
        $rule = new GermanBankAccount($bank, $bav);

        $this->assertSame($bav, $rule->bav);
    }

    public function testShouldHaveAnInstanceOfBAVByDefault()
    {
        $bank = '10000000';
        $rule = new GermanBankAccount($bank);

        $this->assertInstanceOf('malkusch\bav\BAV', $rule->bav);
    }

    public function testShouldUseBAVInstanceToValidate()
    {
        $bank   = '10000000';
        $input  = '67067';
        $bav    = $this->getBavMock();
        $rule   = new GermanBankAccount($bank, $bav);

        $bav->expects($this->once())
            ->method('isValidBankAccount')
            ->with($bank, $input)
            ->will($this->returnValue(true));

        $rule->validate($input);
    }

    public function testShouldReturnBAVInstanceResulteWhenValidating()
    {
        $bank   = '10000000';
        $input  = '67067';
        $bav    = $this->getBavMock();
        $rule   = new GermanBankAccount($bank, $bav);

        $bav->expects($this->any())
            ->method('isValidBankAccount')
            ->with($bank, $input)
            ->will($this->returnValue(true));

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\Locale\GermanBankAccountException
     * @expectedExceptionMessage "67067" must be a german bank account
     */
    public function testShouldThowsTheRightExceptionWhenChecking()
    {
        $bank   = '10000000';
        $input  = '67067';
        $bav    = $this->getBavMock();
        $rule   = new GermanBankAccount($bank, $bav);

        $bav->expects($this->any())
            ->method('isValidBankAccount')
            ->with($bank, $input)
            ->will($this->returnValue(false));

        $rule->check($input);
    }
}
