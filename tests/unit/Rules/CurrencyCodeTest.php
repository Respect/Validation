<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\CurrencyCode
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Justin Hook <justinhook88@yahoo.co.uk>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CurrencyCodeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
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

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
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
