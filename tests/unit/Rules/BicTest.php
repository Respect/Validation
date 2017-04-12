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

use Respect\Validation\Rules\Locale\Factory;
use Respect\Validation\Rules\Locale\GermanBic;
use Respect\Validation\Validatable;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Bic
 * @covers \Respect\Validation\Exceptions\BicException
 */
class BicTest extends LocaleTestCase
{
    public function testShouldUseDefinedFactoryToCreateInternalRuleBasedOnGivenCountryCode()
    {
        $countryCode = 'XX';

        $validatable = $this->createMock(Validatable::class);
        $factory = $this->createMock(Factory::class);
        $factory
            ->expects($this->once())
            ->method('bic')
            ->with($countryCode)
            ->will($this->returnValue($validatable));

        $rule = new Bic($countryCode, $factory);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldUseDefaultFactoryToCreateInternalRuleBasedOnGivenCountryCodeWhenFactoryIsNotDefined()
    {
        $countryCode = 'DE';
        $rule = new Bic($countryCode);

        $this->assertInstanceOf(GermanBic::class, $rule->getValidatable());
    }
}
