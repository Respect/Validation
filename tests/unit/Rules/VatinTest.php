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

use Respect\Validation\Validatable;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Vatin
 */
final class VatinTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAcceptCountryCodeOnConstructor()
    {
        $countryCode = 'PL';
        $rule = new Vatin($countryCode);

        $this->assertInstanceOf(Validatable::class, $rule->getValidatable());
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage There is no support for VAT identification number from "BR"
     */
    public function testShouldThrowAnExceptionWhenCountryCodeIsNotSupported()
    {
        new Vatin('BR');
    }
}
