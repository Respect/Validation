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
 * @covers \Respect\Validation\Rules\PostalCode
 *
 * @author Axel Wargnier <axel@axessweb.fr>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Sebastian <me@sebastianpontow.de>
 */
final class PostalCodeTest extends RuleTestCase
{
    /**
     * @test
     */
    public function shouldValidateEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertValidInput($rule, '');
    }

    /**
     * @test
     */
    public function shouldNotValidateNonEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertInvalidInput($rule, ' ');
    }

    /**
     * @test
     */
    public function shouldThrowsExceptionWhenCountryCodeIsNotValid(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('Cannot validate postal code from "Whatever" country');

        new PostalCode('Whatever');
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new PostalCode('BR'), '02179-000'],
            [new PostalCode('BR'), '02179000'],
            [new PostalCode('CA'), 'A1A 2B2'],
            [new PostalCode('GB'), 'GIR 0AA'],
            [new PostalCode('GB'), 'PR1 9LY'],
            [new PostalCode('US'), '02179'],
            [new PostalCode('YE'), ''],
            [new PostalCode('PL'), '99-300'],
            [new PostalCode('NL'), '1012 GX'],
            [new PostalCode('NL'), '1012GX'],
            [new PostalCode('PT'), '3660-606'],
            [new PostalCode('PT'), '3660606'],
            [new PostalCode('CO'), '110231'],
            [new PostalCode('KR'), '03187'],
            [new PostalCode('IE'), 'D14 YD91'],
            [new PostalCode('IE'), 'D6W 3333'],
            [new PostalCode('EC'), '170515'],
            [new PostalCode('IL'), '7019900'],
            [new PostalCode('IL'), '94142'],
            [new PostalCode('KY'), 'KY1-1102'],
            [new PostalCode('KY'), 'KY2-2001'],
            [new PostalCode('KY'), 'KY2-2001'],
            [new PostalCode('KY'), 'KY3-2500'],
            [new PostalCode('AM'), '0010'],
            [new PostalCode('RS'), '24430'],
            [new PostalCode('RS'), '244300'],
            [new PostalCode('GR'), '24430'],
            [new PostalCode('GR'), '244 30'],
            [new PostalCode('KH'), '12080'],
            [new PostalCode('KH'), '120802'],
            [new PostalCode('CZ', true), '120 80'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new PostalCode('BR'), '02179'],
            [new PostalCode('BR'), '02179.000'],
            [new PostalCode('CA'), '1A1B2B'],
            [new PostalCode('GB'), 'GIR 00A'],
            [new PostalCode('GB', true), 'GIR0AA'],
            [new PostalCode('GB', true), 'PR19LY'],
            [new PostalCode('US'), '021 79'],
            [new PostalCode('YE'), '02179'],
            [new PostalCode('PL'), '99300'],
            [new PostalCode('KR'), '548940'],
            [new PostalCode('KR'), '548-940'],
            [new PostalCode('EC'), 'A1234B'],
            [new PostalCode('KY'), 'KY4-2500'],
            [new PostalCode('AM'), '375010'],
            [new PostalCode('KH'), '1208'],
            [new PostalCode('CZ', true), '12080'],
        ];
    }
}
