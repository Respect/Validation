<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\PhoneException;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Phone
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Firsikov <michael.firsikov@gmail.com>
 * @author Roman Derevianko <roman.derevianko@gmail.com>
 */
final class PhoneTest extends RuleTestCase
{
    public function testThrowsExceptionWithCountryName(): void
    {
        $phoneValidator = new Phone('BR');

        $this->expectException(PhoneException::class);
        $this->expectExceptionMessage('"abc" must be a valid telephone number for country "Brazil"');

        $phoneValidator->assert('abc');
    }

    public function testThrowsExceptionForInternationalNumbers(): void
    {
        $phoneValidator = new Phone();

        $this->expectException(PhoneException::class);
        $this->expectExceptionMessage('"abc" must be a valid telephone number');

        $phoneValidator->assert('abc');
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Phone(), '+1 650 253 00 00'],
            [new Phone(), '+7 (999) 999-99-99'],
            [new Phone(), '+7(999)999-99-99'],
            [new Phone(), '+7(999)999-9999'],
            [new Phone(), '+5-555-555-5555'],
            [new Phone(), '+5 555 555 5555'],
            [new Phone(), '+5.555.555.5555'],
            [new Phone(), '5-555-555-5555'],
            [new Phone(), '5.555.555.5555'],
            [new Phone(), '5 555 555 5555'],
            [new Phone(), '555.555.5555'],
            [new Phone(), '555 555 5555'],
            [new Phone(), '555-555-5555'],
            [new Phone(), '555-5555555'],
            [new Phone(), '5(555)555.5555'],
            [new Phone(), '+5(555)555.5555'],
            [new Phone(), '+5(555)555 5555'],
            [new Phone(), '+5(555)555-5555'],
            [new Phone(), '+5(555)5555555'],
            [new Phone(), '(555)5555555'],
            [new Phone(), '(555)555.5555'],
            [new Phone(), '(555)555-5555'],
            [new Phone(), '(555) 555 5555'],
            [new Phone(), '55555555555'],
            [new Phone(), '5555555555'],
            [new Phone(), '+33(1)2222222'],
            [new Phone(), '+33(1)222 2222'],
            [new Phone(), '+33(1)222.2222'],
            [new Phone(), '+33(1)22 22 22 22'],
            [new Phone(), '33(1)2222222'],
            [new Phone(), '33(1)22222222'],
            [new Phone(), '33(1)22 22 22 22'],
            [new Phone(), '(020) 7476 4026'],
            [new Phone(), '33(020) 7777 7777'],
            [new Phone(), '33(020)7777 7777'],
            [new Phone(), '+33(020) 7777 7777'],
            [new Phone(), '+33(020)7777 7777'],
            [new Phone(), '03-6106666'],
            [new Phone(), '036106666'],
            [new Phone(), '+33(11) 97777 7777'],
            [new Phone(), '+3311977777777'],
            [new Phone(), '11977777777'],
            [new Phone(), '11 97777 7777'],
            [new Phone(), '(11) 97777 7777'],
            [new Phone(), '(11) 97777-7777'],
            [new Phone(), '555-5555'],
            [new Phone(), '5555555'],
            [new Phone(), '555.5555'],
            [new Phone(), '555 5555'],
            [new Phone(), '+1 (555) 555 5555'],
            [new Phone('BR'), '+55 11 91111 1111'],
            [new Phone('BR'), '11 91111 1111'], // no international prefix
            [new Phone('BR'), '+5511911111111'], // no whitespace
            [new Phone('BR'), '11911111111'], // no prefix, no whitespace
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Phone(), ''],
            [new Phone(), '123'],
            [new Phone(), '(11- 97777-7777'],
            [new Phone(), '-11) 97777-7777'],
            [new Phone(), 's555-5555'],
            [new Phone(), '555-555'],
            [new Phone(), '555555'],
            [new Phone(), '555+5555'],
            [new Phone(), '(555)555555'],
            [new Phone(), '(555)55555'],
            [new Phone(), '+(555)555 555'],
            [new Phone(), '+5(555)555 555'],
            [new Phone(), '+5(555)555 555 555'],
            [new Phone(), '555)555 555'],
            [new Phone(), '+5(555)5555 555'],
            [new Phone(), '(555)55 555'],
            [new Phone(), '(555)5555 555'],
            [new Phone(), '+5(555)555555'],
            [new Phone(), '5(555)55 55555'],
            [new Phone(), '(5)555555'],
            [new Phone(), '+55(5)55 5 55 55'],
            [new Phone(), '+55(5)55 55 55 5'],
            [new Phone(), '+55(5)55 55 55'],
            [new Phone(), '+55(5)5555 555'],
            [new Phone(), '+55()555 5555'],
            [new Phone(), '03610666-5'],
            [new Phone(), 'text'],
            [new Phone(), "555\n5555"],
            [new Phone(), []],
            [new Phone(), '+1-650-253-00-0'],
            [new Phone('BR'), '+1 11 91111 1111'], // invalid + code for BR
            [new Phone('BR'), '+1 650 253 00 00'], // invalid + code for BR
        ];
    }
}
