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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\PostalCodeException
 * @covers \Respect\Validation\Rules\PostalCode
 *
 * @author Axel Wargnier <axel@axessweb.fr>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Sebastian <me@sebastianpontow.de>
 */
class PostalCodeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldValidateEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertTrue($rule->validate(''));
    }

    /**
     * @test
     */
    public function shouldNotValidateNonEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertFalse($rule->validate(' '));
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
     * @dataProvider validPostalCodesProvider
     *
     * @test
     */
    public function shouldValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode): void
    {
        $rule = new PostalCode($countryCode);

        self::assertTrue($rule->validate($postalCode));
    }

    public function validPostalCodesProvider()
    {
        return [
            ['BR', '02179-000'],
            ['BR', '02179000'],
            ['CA', 'A1A 2B2'],
            ['GB', 'GIR 0AA'],
            ['GB', 'PR1 9LY'],
            ['US', '02179'],
            ['YE', ''],
            ['PL', '99-300'],
            ['NL', '1012 GX'],
            ['NL', '1012GX'],
            ['PT', '3660-606'],
            ['PT', '3660606'],
            ['CO', '110231'],
            ['KR', '03187'],
        ];
    }

    /**
     * @dataProvider invalidPostalCodesProvider
     *
     * @test
     */
    public function shouldNotValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode): void
    {
        $rule = new PostalCode($countryCode);

        self::assertFalse($rule->validate($postalCode));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\PostalCodeException
     * @expectedExceptionMessage "02179-000" must be a valid postal code on "US"
     *
     * @test
     */
    public function shouldThrowsPostalCodeExceptionWhenValidationFails(): void
    {
        $rule = new PostalCode('US');
        $rule->check('02179-000');
    }

    public function invalidPostalCodesProvider()
    {
        return [
            ['BR', '02179'],
            ['BR', '02179.000'],
            ['CA', '1A1B2B'],
            ['GB', 'GIR 00A'],
            ['GB', 'GIR0AA'],
            ['GB', 'PR19LY'],
            ['US', '021 79'],
            ['YE', '02179'],
            ['PL', '99300'],
            ['KR', '548940'],
            ['KR', '548-940'],
        ];
    }
}
