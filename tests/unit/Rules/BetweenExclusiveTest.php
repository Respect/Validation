<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractEnvelope
 * @covers \Respect\Validation\Rules\BetweenExclusive
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BetweenExclusiveTest extends RuleTestCase
{
    /**
     * @test
     */
    public function minimumValueShouldNotBeGreaterThanMaximumValue(): void
    {
        $this->expectExceptionObject(new ComponentException('Minimum cannot be less than or equals to maximum'));

        new BetweenExclusive(10, 5);
    }

    /**
     * @test
     */
    public function minimumValueShouldNotBeEqualsToMaximumValue(): void
    {
        $this->expectExceptionObject(new ComponentException('Minimum cannot be less than or equals to maximum'));

        new BetweenExclusive(5, 5);
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new BetweenExclusive(0, 2), 1],
            [new BetweenExclusive(10, 20), 15],
            [new BetweenExclusive(-10, 20), -5],
            [new BetweenExclusive(-10, 20), 0],
            [new BetweenExclusive('a', 'z'), 'j'],
            [new BetweenExclusive(new DateTime('yesterday'), new DateTime('tomorrow')), new DateTime('now')],
            [new BetweenExclusive(new CountableStub(1), new CountableStub(10)), 5],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new BetweenExclusive(10, 20), ''],
            [new BetweenExclusive(0, 2), 2],
            [new BetweenExclusive(0, 2), 0],
            [new BetweenExclusive(0, 1), 1],
            [new BetweenExclusive(10, 20), 10],
            [new BetweenExclusive(10, 20), 20],
            [new BetweenExclusive(0, 1), 2],
            [new BetweenExclusive(0, 1), -1],
            [new BetweenExclusive(10, 20), 999],
            [new BetweenExclusive(-10, 20), -11],
            [new BetweenExclusive('a', 'j'), 'z'],
            [new BetweenExclusive(new DateTime('yesterday'), new DateTime('now')), new DateTime('tomorrow')],
            [new BetweenExclusive(new CountableStub(1), new CountableStub(10)), 11],
        ];
    }
}
