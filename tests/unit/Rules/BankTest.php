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
 * @covers Respect\Validation\Rules\Bank
 * @covers Respect\Validation\Exceptions\BankException
 */
class BankTest extends LocaleTestCase
{
    public function testShouldUseDefinedFactoryToCreateInternalRuleBasedOnGivenCountryCode()
    {
        $countryCode = 'XX';

        $validatable = $this->getMock('Respect\Validation\Validatable');
        $factory = $this->getMock('Respect\Validation\Rules\Locale\Factory');
        $factory
            ->expects($this->once())
            ->method('bank')
            ->with($countryCode)
            ->will($this->returnValue($validatable));

        $rule = new Bank($countryCode, $factory);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldUseDefaultFactoryToCreateInternalRuleBasedOnGivenCountryCodeWhenFactoryIsNotDefined()
    {
        $countryCode = 'DE';
        $rule = new Bank($countryCode);

        $this->assertInstanceOf('Respect\Validation\Rules\Locale\GermanBank', $rule->getValidatable());
    }
}
