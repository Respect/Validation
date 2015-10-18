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
 * @covers Respect\Validation\Rules\CurrencyCode
 */
class CurrencyCodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurrencyCode
     */
    protected $currencyCodeValidator;

    protected function setUp()
    {
        $this->currencyCodeValidator = new CurrencyCode();
    }

    public function providerForValidCurrencyCode()
    {
        return [
            ['EUR'],
            ['GBP'],
            ['XAU'],
            ['xba'],
            ['xxx']
        ];
    }

    public function providerForInvalidCurrencyCode()
    {
        return [
            ['BTC'],
            ['GGP'],
            ['USA']
        ];
    }

    /**
     * @dataProvider providerForValidCurrencyCode
     */
    public function testValidCurrencyCodes($input)
    {
        $this->assertTrue($this->currencyCodeValidator->validate($input));
    }

    /**
     * @dataProvider providerForInvalidCurrencyCode
     */
    public function testInvalidCurrencyCodes($input)
    {
        $this->assertFalse($this->currencyCodeValidator->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CurrencyCodeException
     * @expectedExceptionMessage "BTC" must be a valid currency
     */
    public function testShouldThrowTheRightExceptionWhenChecking()
    {
        $this->currencyCodeValidator->check('BTC');
    }
}
