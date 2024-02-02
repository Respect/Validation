<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\CountryCode
 *
 * @author Felipe Martins <me@fefas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CountryCodeTest extends RuleTestCase
{
    /**
     * @test
     */
    public function itShouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(
            '"whatever" is not a valid set for ISO 3166-1 (Available: alpha-2, alpha-3, numeric)'
        );

        new CountryCode('whatever');
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
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
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new CountryCode(),  'ca'],
            [new CountryCode(CountryCode::ALPHA2),  'USA'],
            [new CountryCode(CountryCode::ALPHA3),  'US'],
            [new CountryCode(CountryCode::NUMERIC), '000'],
        ];
    }
}
