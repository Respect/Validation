<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\LocaleTestCase;

/**
 * @covers Respect\Validation\Rules\Locale\Factory
 */
class FactoryTest extends LocaleTestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot provide BIC validation for country "XX"
     */
    public function testShouldThrowExceptionWhenFailedToGetBICRule()
    {
        $factory = new Factory();
        $factory->bic('XX');
    }

    public function testShouldReturnBICRuleAccordingToCountry()
    {
        $factory = new Factory();

        $this->assertInstanceOf('Respect\Validation\Validatable', $factory->bic('DE'));
    }

    public function testShouldNotBeCaseSensitiveToReturnBICRuleAccordingToCountry()
    {
        $factory = new Factory();

        $this->assertEquals($factory->bic('DE'), $factory->bic('de'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot provide bank validation for country "XX"
     */
    public function testShouldThrowExceptionWhenFailedToGetBankRule()
    {
        $factory = new Factory();
        $factory->bank('XX');
    }

    public function testShouldReturnBankRuleAccordingToCountry()
    {
        $factory = new Factory();

        $this->assertInstanceOf('Respect\Validation\Validatable', $factory->bank('DE'));
    }

    public function testShouldNotBeCaseSensitiveToReturnBankRuleAccordingToCountry()
    {
        $factory = new Factory();

        $this->assertEquals($factory->bank('DE'), $factory->bank('de'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot provide bank account validation for country "XX" and bank "123"
     */
    public function testShouldThrowExceptionWhenFailedToGetBankAccountRule()
    {
        $factory = new Factory();
        $factory->bankAccount('XX', '123');
    }

    public function testShouldReturnBankAccountRuleAccordingToCountry()
    {
        $factory = new Factory();

        $this->assertInstanceOf('Respect\Validation\Validatable', $factory->bankAccount('DE', '123'));
    }

    public function testShouldNotBeCaseSensitiveToReturnBankAccountRuleAccordingToCountry()
    {
        $factory = new Factory();

        $this->assertEquals($factory->bankAccount('DE', '123'), $factory->bankAccount('de', '123'));
    }
}
