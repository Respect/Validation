<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\Bank
 */
class BankTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (false === class_exists('malkusch\\bav\\BAV')) {
            $this->markTestSkipped('"malkusch/bav" is not installed.');
        }
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate bank for country "xx"
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        new Bank('xx');
    }

    public function testCountryCodeIsCaseUnsensitive()
    {
        $rule1 = new Bank('de');
        $rule2 = new Bank('DE');

        $this->assertSame($rule1->validate('foo'), $rule2->validate('foo'));
    }

    /**
     * @dataProvider providerForBank
     */
    public function testValidBankShouldReturnTrue($countryCode, $bank)
    {
        $rule = new Bank($countryCode);

        $this->assertTrue($rule->validate($bank));
    }

    /**
     * @dataProvider providerForNotBank
     * @expectedException Respect\Validation\Exceptions\BankException
     * @expectedExceptionMessageRegExp /^"[^"]+" must be a bank$/
     */
    public function testInvalidBankShouldRaiseException($countryCode, $bank)
    {
        $rule = new Bank($countryCode);
        $rule->check($bank);
    }

    /**
     * @dataProvider providerForNotBank
     */
    public function testInvalidBankShouldReturnFalse($countryCode, $bank)
    {
        $rule = new Bank($countryCode);

        $this->assertFalse($rule->validate($bank));
    }

    public function providerForNotBank()
    {
        return array(
            array('de', '1234'),
        );
    }

    public function providerForBank()
    {
        return array(
            array('de', '10000000'),
        );
    }
}
