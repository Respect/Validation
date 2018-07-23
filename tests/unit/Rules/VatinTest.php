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
    /**
     * @test
     */
    public function shouldAcceptCountryCodeOnConstructor(): void
    {
        $countryCode = 'PL';
        $rule = new Vatin($countryCode);

        self::assertAttributeInstanceOf(Validatable::class, 'validatable', $rule);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "BR" is not a supported country code
     *
     * @test
     */
    public function shouldThrowAnExceptionWhenCountryCodeIsNotSupported(): void
    {
        new Vatin('BR');
    }
}
