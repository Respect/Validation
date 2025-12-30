<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(PostalCode::class)]
final class PostalCodeTest extends RuleTestCase
{
    #[Test]
    public function shouldValidateEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertValidInput($rule, '');
    }

    #[Test]
    public function shouldNotValidateNonEmptyStringsWhenUsingDefaultPattern(): void
    {
        $rule = new PostalCode('ZW');

        self::assertInvalidInput($rule, ' ');
    }

    #[Test]
    public function shouldThrowsExceptionWhenCountryCodeIsNotValid(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage('Cannot validate postal code from "Whatever" country');

        new PostalCode('Whatever');
    }

    /** @return iterable<array{PostalCode, mixed}> */
    public static function providerForValidInput(): iterable
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

    /** @return iterable<array{PostalCode, mixed}> */
    public static function providerForInvalidInput(): iterable
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
