<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

#[Group('rule')]
#[CoversClass(AbstractEnvelope::class)]
#[CoversClass(Between::class)]
final class BetweenTest extends RuleTestCase
{
    #[Test]
    public function minimumValueShouldNotBeGreaterThanMaximumValue(): void
    {
        $this->expectExceptionObject(new ComponentException('Minimum cannot be less than or equals to maximum'));

        new Between(10, 5);
    }

    #[Test]
    public function minimumValueShouldNotBeEqualsToMaximumValue(): void
    {
        $this->expectExceptionObject(new ComponentException('Minimum cannot be less than or equals to maximum'));

        new Between(5, 5);
    }

    /**
     * @return array<array{Between, mixed}>
     */
    public static function providerForValidInput(): array
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

    /**
     * @return array<array{Between, mixed}>
     */
    public static function providerForInvalidInput(): array
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
