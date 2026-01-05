<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(CurrencyCode::class)]
final class CurrencyCodeTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage(
            '"whatever" is not a valid set for ISO 4217 (Available: "alpha-3" and "numeric")',
        );

        // @phpstan-ignore-next-line
        new CurrencyCode('whatever');
    }

    /** @return iterable<array{CurrencyCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new CurrencyCode(), 'EUR'],
            [new CurrencyCode('numeric'), '978'],
            [new CurrencyCode(), 'GBP'],
            [new CurrencyCode('numeric'), '826'],
            [new CurrencyCode(), 'XAU'],
            [new CurrencyCode('numeric'), '959'],
            [new CurrencyCode(), 'XBA'],
            [new CurrencyCode('numeric'), '955'],
            [new CurrencyCode(), 'XXX'],
            [new CurrencyCode('numeric'), '999'],
        ];
    }

    /** @return iterable<array{CurrencyCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new CurrencyCode(), ''],
            [new CurrencyCode('numeric'), '123'],
            [new CurrencyCode(), 'BTC'],
            [new CurrencyCode(), 'GGP'],
            [new CurrencyCode(), 'USA'],
        ];
    }
}
