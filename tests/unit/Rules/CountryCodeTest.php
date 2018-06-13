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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\CountryCode
 *
 * @author Felipe Martins <me@fefas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William espindola <oi@williamespindola.com.br>
 */
final class CountryCodeTest extends RuleTestCase
{
    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid set for ISO 3166-1 (Available: alpha-2, alpha-3, numeric)
     */
    public function itShouldThrowsExceptionWhenInvalidFormat(): void
    {
        new CountryCode('whatever');
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new CountryCode(CountryCode::ALPHA2),  'BR'],
            [new CountryCode(CountryCode::ALPHA3),  'BRA'],
            [new CountryCode(CountryCode::NUMERIC), '076'],
            [new CountryCode(CountryCode::ALPHA2),  'DE'],
            [new CountryCode(CountryCode::ALPHA3),  'DEU'],
            [new CountryCode(CountryCode::NUMERIC), '276'],
            [new CountryCode(CountryCode::ALPHA2),  'US'],
            [new CountryCode(CountryCode::ALPHA3),  'USA'],
            [new CountryCode(CountryCode::NUMERIC), '840'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new CountryCode(CountryCode::ALPHA2),  'USA'],
            [new CountryCode(CountryCode::ALPHA3),  'US'],
            [new CountryCode(CountryCode::NUMERIC), '000'],
        ];
    }
}
