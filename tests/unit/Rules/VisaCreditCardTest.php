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
 * @covers Respect\Validation\Rules\VisaCreditCard
 * @covers Respect\Validation\Exceptions\VisaCreditCardException
 */
class VisaCreditCardTest extends \PHPUnit_Framework_TestCase
{
    protected $VisaCreditCardValidator;

    protected function setUp()
    {
        $this->VisaCreditCardValidator = new VisaCreditCard();
    }

    /**
     * @dataProvider providerForVisaCreditCard
     */
    public function testValidVisaCreditCard($input)
    {
        $this->assertTrue($this->VisaCreditCardValidator->__invoke($input));
        $this->assertTrue($this->VisaCreditCardValidator->assert($input));
        $this->assertTrue($this->VisaCreditCardValidator->check($input));
        $this->assertTrue($this->VisaCreditCardValidator->validate($input));
    }

    /**
     * @dataProvider providerForNotValidVisaCreditCard
     * @expectedException Respect\Validation\Exceptions\VisaCreditCardException
     */
    public function testNotValidVisaCreditCard($input)
    {
        $this->assertFalse($this->VisaCreditCardValidator->__invoke($input));
        $this->assertFalse($this->VisaCreditCardValidator->assert($input));
        $this->assertFalse($this->VisaCreditCardValidator->validate($input));
    }

    public function providerForVisaCreditCard()
    {
        return array(
            array('4024.0071.5336.1885'), 
            array('4111.1111.1111.1111'), 
            array('4024.0071.5336.1885'), // Visa 16
            array('4024 007 193 879'), // Visa 13
            array('4485694030053942'),
        );
    }

    public function providerForNotValidVisaCreditCard($input)
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
