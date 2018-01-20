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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\CreditCard
 */
class CreditCardTest extends RuleTestCase
{
    public function testShouldHaveNoCreditCardBrandByDefault(): void
    {
        $rule = new CreditCard();

        self::assertNull($rule->brand);
    }

    public function testShouldAcceptCreditCardBrandOnConstructor(): void
    {
        $rule = new CreditCard(CreditCard::VISA);

        self::assertSame(CreditCard::VISA, $rule->brand);
    }

    public function testShouldThrowExceptionWhenCreditCardBrandIsNotValid(): void
    {
        $message = '"RespectCard" is not a valid credit card brand';
        $message .= ' (Available: American Express, Diners Club, Discover, JCB, MasterCard, Visa).';

        $this->expectException(ComponentException::class, $message);

        new CreditCard('RespectCard');
    }

    public function providerForValidInput(): array
    {
        $general = new CreditCard();
        $amex = new CreditCard(CreditCard::AMERICAN_EXPRESS);
        $diners = new CreditCard(CreditCard::DINERS_CLUB);
        $discover = new CreditCard(CreditCard::DISCOVER);
        $jcb = new CreditCard(CreditCard::JCB);
        $master = new CreditCard(CreditCard::MASTERCARD);
        $visa = new CreditCard(CreditCard::VISA);

        return [
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
        ];
    }

    public function providerForInvalidInput(): array
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
