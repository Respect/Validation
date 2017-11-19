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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Tld
 */
class TldTest extends TestCase
{
    public function providerForValidTld()
    {
        return [
            ['br'],
            ['cafe'],
            ['com'],
            ['democrat'],
            ['eu'],
            ['gmbh'],
            ['us'],
        ];
    }

    /**
     * @dataProvider providerForValidTld
     */
    public function testShouldValidateInputWhenItIsAValidTld($input): void
    {
        $rule = new Tld();

        self::assertTrue($rule->validate($input));
    }

    public function providerForInvalidTld()
    {
        return [
            ['1'],
            [1.0],
            ['wrongtld'],
            [true],
        ];
    }

    /**
     * @dataProvider providerForInvalidTld
     */
    public function testShouldInvalidateInputWhenItIsNotAValidTld($input): void
    {
        $rule = new Tld();

        self::assertFalse($rule->validate($input));
    }
}
