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
 * @covers \Respect\Validation\Rules\Phone
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
     * @return array<array{Phone, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Phone(), '+1 650 253 00 00'],
            [new Phone(), '+7 (999) 999-99-99'],
            [new Phone(), '+7(999)999-99-99'],
            [new Phone(), '+7(999)999-9999'],
            [new Phone('BR'), '+55 11 91111 1111'],
            [new Phone('BR'), '11 91111 1111'], // no international prefix
            [new Phone('BR'), '+5511911111111'], // no whitespace
            [new Phone('BR'), '11911111111'], // no prefix, no whitespace
        ];
    }

    /**
     * @return array<array{Phone, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Phone(), '+1-650-253-00-0'],
            [new Phone('BR'), '+1 11 91111 1111'], // invalid + code for BR
        ];
    }
}
