<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(CurrencyCode::class)]
final class CurrencyCodeTest extends RuleTestCase
{
    /** @return iterable<array{CurrencyCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new CurrencyCode();

        return [
            [$rule, 'EUR'],
            [$rule, 'GBP'],
            [$rule, 'XAU'],
            [$rule, 'XBA'],
            [$rule, 'XXX'],
        ];
    }

    /** @return iterable<array{CurrencyCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new CurrencyCode();

        return [
            [$rule, ''],
            [$rule, 'BTC'],
            [$rule, 'GGP'],
            [$rule, 'USA'],
        ];
    }
}
