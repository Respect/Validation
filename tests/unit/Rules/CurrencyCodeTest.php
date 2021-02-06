<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
    public function providerForValidInput(): array
    {
        return [
            [new CurrencyCode(), 'EUR'],
            [new CurrencyCode(), 'GBP'],
            [new CurrencyCode(), 'XAU'],
            [new CurrencyCode(CurrencyCode::ALPHA3), 'XBA'],
            [new CurrencyCode(CurrencyCode::ALPHA3), 'XXX'],
            [new CurrencyCode(CurrencyCode::NUMERIC), '784'],
            [new CurrencyCode(CurrencyCode::NUMERIC), '971'],
            [new CurrencyCode(CurrencyCode::NUMERIC), '008'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new CurrencyCode(), 'BTC'],
            [new CurrencyCode(), 'GGP'],
            [new CurrencyCode(), 'USA'],
            [new CurrencyCode(), 'xxx'],
        ];
    }
}
