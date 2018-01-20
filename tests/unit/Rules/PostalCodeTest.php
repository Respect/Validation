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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\PostalCode
 * @covers \Respect\Validation\Exceptions\PostalCodeException
 */
class PostalCodeTest extends TestCase
{
    public function testShouldUsePatternAccordingToCountryCode(): void
    {
        $countryCode = 'BR';

        $rule = new PostalCode($countryCode);

        $actualPattern = $rule->regex;
        $expectedPattern = $rule->postalCodes[$countryCode];

        self::assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldNotBeCaseSensitiveWhenChoosingPatternAccordingToCountryCode(): void
    {
        $rule1 = new PostalCode('BR');
        $rule2 = new PostalCode('br');

        self::assertEquals($rule1->regex, $rule2->regex);
    }

    public function testShouldUseDefaultPatternWhenCountryCodeDoesNotHavePostalCode(): void
    {
        $rule = new PostalCode('ZW');

        $actualPattern = $rule->regex;
        $expectedPattern = PostalCode::DEFAULT_PATTERN;

        self::assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldValidateEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertTrue($rule->validate(''));
    }

    public function testShouldNotValidateNonEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertFalse($rule->validate(' '));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate postal code from "Whatever" country
     */
    public function testShouldThrowsExceptionWhenCountryCodeIsNotValid(): void
    {
        new PostalCode('Whatever');
    }

    /**
     * @dataProvider validPostalCodesProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode): void
    {
        $rule = new PostalCode($countryCode);

        self::assertTrue($rule->validate($postalCode));
    }

    public function validPostalCodesProvider()
    {
        return [
            ['BR', '02179-000'],
            ['BR', '02179000'],
            ['GB', 'GIR 0AA'],
            ['GB', 'PR1 9LY'],
            ['US', '02179'],
            ['YE', ''],
            ['PL', '99-300'],
        ];
    }

    /**
     * @dataProvider invalidPostalCodesProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedCountryCode($countryCode, $postalCode): void
    {
        $rule = new PostalCode($countryCode);

        self::assertFalse($rule->validate($postalCode));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\PostalCodeException
     * @expectedExceptionMessage "02179-000" must be a valid postal code on "US"
     */
    public function testShouldThrowsPostalCodeExceptionWhenValidationFails(): void
    {
        $rule = new PostalCode('US');
        $rule->check('02179-000');
    }

    public function invalidPostalCodesProvider()
    {
        return [
            ['BR', '02179'],
            ['BR', '02179.000'],
            ['GB', 'GIR 00A'],
            ['GB', 'GIR0AA'],
            ['GB', 'PR19LY'],
            ['US', '021 79'],
            ['YE', '02179'],
            ['PL', '99300'],
        ];
    }
}
