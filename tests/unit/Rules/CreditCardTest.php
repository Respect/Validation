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
 * @covers Respect\Validation\Rules\CreditCard
 * @covers Respect\Validation\Exceptions\CreditCardException
 */
class CreditCardTest extends \PHPUnit_Framework_TestCase
{
    protected $creditCardValidator;

    protected function setUp()
    {
        $this->creditCardValidator = new CreditCard();
    }

    /**
     * @dataProvider providerForCreditCard
     */
    public function testValidCreditCardsShouldReturnTrue($input)
    {
        $this->assertTrue($this->creditCardValidator->__invoke($input));
        $this->assertTrue($this->creditCardValidator->assert($input));
        $this->assertTrue($this->creditCardValidator->check($input));
    }

    /**
     * @dataProvider providerForNotCreditCard
     * @expectedException Respect\Validation\Exceptions\CreditCardException
     */
    public function testInvalidCreditCardsShouldThrowCreditCardException($input)
    {
        $this->assertFalse($this->creditCardValidator->__invoke($input));
        $this->assertFalse($this->creditCardValidator->assert($input));
    }

    public function providerForCreditCard()
    {
        return array(
            array('5376 7473 9720 8720'), // MasterCard
            array('4024.0071.5336.1885'), // Visa 16
            array('4024 007 193 879'), // Visa 13
            array('340-3161-9380-9364'), // AmericanExpress
            array('30351042633884'), // Dinners
        );
    }

    public function providerForNotCreditCard()
    {
        return array(
            array(''),
            array(null),
            array('it isnt my credit card number'),
            array('&stR@ng3|) (|-|@r$'),
            array('1234 1234 1234 1234'),
            array('1234.1234.1234.1234'),
        );
    }
}
