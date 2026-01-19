<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Torben Brodt <t.brodt@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

#[Group('validator')]
#[CoversClass(Between::class)]
final class BetweenTest extends RuleTestCase
{
    #[Test]
    public function minimumValueShouldNotBeGreaterThanMaximumValue(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('Minimum cannot be less than or equals to maximum');

        new Between(10, 5);
    }

    #[Test]
    public function minimumValueShouldNotBeEqualsToMaximumValue(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('Minimum cannot be less than or equals to maximum');

        new Between(5, 5);
    }

    /** @return iterable<array{Between, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Between(0, 1), 1],
            [new Between(0, 1), 0],
            [new Between(10, 20), 15],
            [new Between(10, 20), 20],
            [new Between(-10, 20), -5],
            [new Between(-10, 20), 0],
            [new Between('a', 'z'), 'j'],
            [new Between(new DateTime('yesterday'), new DateTime('tomorrow')), new DateTime('now')],
            [new Between(new CountableStub(1), new CountableStub(10)), 5],
        ];
    }

    /** @return iterable<array{Between, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Between(10, 20), ''],
            [new Between(10, 20), ''],
            [new Between(0, 1), 2],
            [new Between(0, 1), -1],
            [new Between(10, 20), 999],
            [new Between(-10, 20), -11],
            [new Between('a', 'j'), 'z'],
            [new Between(new DateTime('yesterday'), new DateTime('now')), new DateTime('tomorrow')],
            [new Between(new CountableStub(1), new CountableStub(10)), 11],
        ];
    }
}
