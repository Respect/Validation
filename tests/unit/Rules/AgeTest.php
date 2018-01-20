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
use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Age
 * @covers \Respect\Validation\Exceptions\AgeException
 */
class AgeTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage An age interval must be provided
     */
    public function testShouldThrowsExceptionWhenThereIsNoArgumentsOnConstructor(): void
    {
        new Age();
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage 20 cannot be greater than or equals to 10
     */
    public function testShouldThrowsExceptionWhenMinimumAgeIsLessThenMaximumAge(): void
    {
        new Age(20, 10);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage 20 cannot be greater than or equals to 20
     */
    public function testShouldThrowsExceptionWhenMinimumAgeIsEqualsToMaximumAge(): void
    {
        new Age(20, 20);
    }

    public function providerForValidAge()
    {
        return [
            [18, null, date('Y-m-d', strtotime('-18 years'))],
            [18, null, date('Y-m-d', strtotime('-19 years'))],
            [18, null, new DateTime('-18 years')],
            [18, null, new DateTime('-19 years')],

            [18, 50, date('Y-m-d', strtotime('-18 years'))],
            [18, 50, date('Y-m-d', strtotime('-50 years'))],
            [18, 50, new DateTime('-18 years')],
            [18, 50, new DateTime('-50 years')],

            [null, 50, date('Y-m-d', strtotime('-49 years'))],
            [null, 50, date('Y-m-d', strtotime('-50 years'))],
            [null, 50, new DateTime('-49 years')],
            [null, 50, new DateTime('-50 years')],
        ];
    }

    /**
     * @dataProvider providerForValidAge
     */
    public function testShouldValidateValidAge($minAge, $maxAge, $input): void
    {
        $rule = new Age($minAge, $maxAge);

        self::assertTrue($rule->validate($input));
    }

    public function providerForInvalidAge()
    {
        return [
            [18, null, date('Y-m-d', strtotime('-17 years'))],
            [18, null, new DateTime('-17 years')],

            [18, 50, date('Y-m-d', strtotime('-17 years'))],
            [18, 50, date('Y-m-d', strtotime('-51 years'))],
            [18, 50, new DateTime('-17 years')],
            [18, 50, new DateTime('-51 years')],

            [null, 50, date('Y-m-d', strtotime('-51 years'))],
            [null, 50, new DateTime('-51 years')],
        ];
    }

    /**
     * @dataProvider providerForInvalidAge
     */
    public function testShouldValidateInvalidAge($minAge, $maxAge, $input): void
    {
        $rule = new Age($minAge, $maxAge);

        self::assertFalse($rule->validate($input));
    }

    /**
     * @depends testShouldValidateInvalidAge
     *
     * @expectedException \Respect\Validation\Exceptions\AgeException
     * @expectedExceptionMessage "today" must be lower than 18 years ago
     */
    public function testShouldThrowsExceptionWhenMinimumAgeFails(): void
    {
        $rule = new Age(18);
        $rule->assert('today');
    }

    /**
     * @depends testShouldValidateInvalidAge
     *
     * @expectedException \Respect\Validation\Exceptions\AgeException
     * @expectedExceptionMessage "51 years ago" must be greater than 50 years ago
     */
    public function testShouldThrowsExceptionWhenMaximunAgeFails(): void
    {
        $rule = new Age(null, 50);
        $rule->assert('51 years ago');
    }

    /**
     * @depends testShouldValidateInvalidAge
     *
     * @expectedException \Respect\Validation\Exceptions\AgeException
     * @expectedExceptionMessage "today" must be between 18 and 50 years ago
     */
    public function testShouldThrowsExceptionWhenMinimunAndMaximunAgeFails(): void
    {
        $rule = new Age(18, 50);
        $rule->assert('today');
    }
}
