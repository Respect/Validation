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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\CreditCardVisa
 * @covers Respect\Validation\Exceptions\CreditCardVisaException
 */
class CreditCardVisaTest extends \PHPUnit_Framework_TestCase
{
    protected $creditCardVisaValidator;

    protected function setUp()
    {
        $this->creditCardVisaValidator = new CreditCardVisa();
    }

    /**
     * @dataProvider providerForCreditCardVisa
     */
    public function testValidCreditCardVisa($input)
    {
        $this->assertTrue($this->creditCardVisaValidator->__invoke($input));
        $this->assertTrue($this->creditCardVisaValidator->assert($input));
        $this->assertTrue($this->creditCardVisaValidator->check($input));
        $this->assertTrue($this->creditCardVisaValidator->validate($input));
    }

    /**
     * @dataProvider providerForNotValidCreditCardVisa
     * @expectedException Respect\Validation\Exceptions\CreditCardVisaException
     */
    public function testNotValidCreditCardVisa($input)
    {
        $this->assertFalse($this->creditCardVisaValidator->__invoke($input));
        $this->assertFalse($this->creditCardVisaValidator->assert($input));
        $this->assertFalse($this->creditCardVisaValidator->validate($input));
    }

    public function providerForCreditCardVisa()
    {
        return array(
            array('4024.0071.5336.1885'), 
            array('4111.1111.1111.1111'), 
            array('4024.0071.5336.1885'), // Visa 16
            array('4024 007 193 879'), // Visa 13
            array('4485694030053942'),
        );
    }

    public function providerForNotValidCreditCardVisa($input)
    {
        return array(
            array(''),
            array(null),
            array('it isnt my credit card number'),
            array('&stR@ng3|) (|-|@r$'),
            array('1234 1234 1234 1234'),
            array('1234.1234.1234.1234'),
            array('5376 7473 9720 8720'), // MasterCard
            array('340-3161-9380-9364'), // AmericanExpress
            array('30351042633884'), // Dinners
        );
    }
}
