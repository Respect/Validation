<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Validatable;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Vatin
 */
final class VatinTest extends TestCase
{
    public function testShouldAcceptCountryCodeOnConstructor(): void
    {
        $countryCode = 'PL';
        $rule = new Vatin($countryCode);

        self::assertInstanceOf(Validatable::class, $rule->getValidatable());
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage There is no support for VAT identification number from "BR"
     */
    public function testShouldThrowAnExceptionWhenCountryCodeIsNotSupported(): void
    {
        new Vatin('BR');
    }
}
