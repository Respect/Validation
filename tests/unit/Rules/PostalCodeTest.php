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
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate postal code from "Whatever" country
     *
     * @test
     */
    public function shouldThrowsExceptionWhenCountryCodeIsNotValid(): void
    {
        new PostalCode('Whatever');
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new PostalCode('BR'), '02179'],
            [new PostalCode('BR'), '02179.000'],
            [new PostalCode('CA'), '1A1B2B'],
            [new PostalCode('GB'), 'GIR 00A'],
            [new PostalCode('GB'), 'GIR0AA'],
            [new PostalCode('GB'), 'PR19LY'],
            [new PostalCode('US'), '021 79'],
            [new PostalCode('YE'), '02179'],
            [new PostalCode('PL'), '99300'],
            [new PostalCode('KR'), '548940'],
            [new PostalCode('KR'), '548-940'],
        ];
    }
}
