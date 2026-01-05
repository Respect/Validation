<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(CreditCard::class)]
final class CreditCardTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowExceptionWhenCreditCardBrandIsNotValid(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessageMatches('/"RespectCard" is not a valid credit card brand \(Available: .+\)/');

        new CreditCard('RespectCard');
    }

    /** @return iterable<array{CreditCard, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $general = new CreditCard();
        $amex = new CreditCard(CreditCard::AMERICAN_EXPRESS);
        $diners = new CreditCard(CreditCard::DINERS_CLUB);
        $discover = new CreditCard(CreditCard::DISCOVER);
        $jcb = new CreditCard(CreditCard::JCB);
        $master = new CreditCard(CreditCard::MASTERCARD);
        $visa = new CreditCard(CreditCard::VISA);
        $rupay = new CreditCard(CreditCard::RUPAY);

        return [
            [$general, 5555444433331111], // MasterCard 5 BIN Range
            [$general, '5376 7473 9720 8720'], // MasterCard 5 BIN Range
            [$master, '5376 7473 9720 8720'],
            [$general, '2223000048400011'], // MasterCard 2 BIN Range
            [$master, '2222 4000 4124 0011'],
            [$general, '4024.0071.5336.1885'], // Visa 16
            [$visa, '4024.0071.5336.1885'],
            [$general, '4024 007 193 879'], // Visa 13
            [$visa, '4024 007 193 879'],
            [$general, '340-3161-9380-9364'], // American Express
            [$amex, '340-3161-9380-9364'],
            [$general, '30351042633884'], // Diners Club
            [$diners, '30351042633884'],
            [$general, '6011000990139424'], // Discover
            [$discover, '6011000990139424'],
            [$general, '3566002020360505'], // JBC
            [$jcb, '3566002020360505'],
            [$general, '6522447005971501'], // RuPay
            [$rupay, '6062973831636410'],
        ];
    }

    /** @return iterable<array{CreditCard, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $general = new CreditCard();
        $amex = new CreditCard(CreditCard::AMERICAN_EXPRESS);
        $diners = new CreditCard(CreditCard::DINERS_CLUB);
        $discover = new CreditCard(CreditCard::DISCOVER);
        $jcb = new CreditCard(CreditCard::JCB);
        $master = new CreditCard(CreditCard::MASTERCARD);
        $visa = new CreditCard(CreditCard::VISA);

        return [
            [$general, ''],
            [$general, null],
            [$general, []],
            [$general, 'it isnt my credit card number'],
            [$general, '&stR@ng3|) (|-|@r$'],
            [$general, '1234 1234 1234 1234'],
            [$general, '1234.1234.1234.1234'],
            [$master, '6011111111111117'], // Discover
            [$visa, '3530111333300000'], // JCB
            [$amex, '5555555555554444'], // MasterCard
            [$diners, '4012888888881881'], // Visa
            [$discover, '371449635398431'], // American Express
            [$jcb, '38520000023237'], // Diners Club
        ];
    }
}
