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

use DateTime;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Between
 * @covers \Respect\Validation\Exceptions\BetweenException
 */
final class BetweenTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Between(0, 1, true), 1],
            [new Between(0, 1, true), 0],
            [new Between(10, 20, false), 15],
            [new Between(10, 20, true), 20],
            [new Between(-10, 20, false), -5],
            [new Between(-10, 20, false), 0],
            [new Between('a', 'z', false), 'j'],
            [new Between(new DateTime('yesterday'), new DateTime('tomorrow'), false), new DateTime('now')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Between(10, 20, false), ''],
            [new Between(10, 20, true), ''],
            [new Between(0, 1, false), 0],
            [new Between(0, 1, false), 1],
            [new Between(0, 1, false), 2],
            [new Between(0, 1, false), -1],
            [new Between(10, 20, false), 999],
            [new Between(10, 20, false), 20],
            [new Between(-10, 20, false), -11],
            [new Between('a', 'j', false), 'z'],
            [new Between(new DateTime('yesterday'), new DateTime('now'), false), new DateTime('tomorrow')],
        ];
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage 10 cannot be less than or equals to 5
     */
    public function minimumValueShouldNotBeGreaterThanMaximumValue(): void
    {
        new Between(10, 5);
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage 5 cannot be less than or equals to 5
     */
    public function minimumValueShouldNotBeEqualsToMaximumValue(): void
    {
        new Between(5, 5);
    }
}
