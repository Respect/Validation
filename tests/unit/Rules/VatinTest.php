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

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Validatable;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Vatin
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Tomasz Regdos <tomek@regdos.com>
 */
final class VatinTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $countryCode = 'PL';
        $rule = new Vatin($countryCode);

        return [
            [$rule, '1645865777'],
            [$rule, '5581418257'],
            [$rule, '1298727531'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $countryCode = 'PL';
        $rule = new Vatin($countryCode);

        return [
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, '1645865778'],
            [$rule, '164-586-57-77'],
            [$rule, '164-58-65-777'],
            [$rule, '5581418258'],
            [$rule, '1298727532'],
            [$rule, '1234567890'],
        ];
    }

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
