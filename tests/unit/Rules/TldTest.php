<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Tld
 */
class TldTest extends TestCase
{
    public function providerForValidTld()
    {
        return [
            ['com'],
            ['cafe'],
            ['democrat'],
            ['br'],
            ['us'],
            ['eu'],
        ];
    }

    /**
     * @dataProvider providerForValidTld
     */
    public function testShouldValidateInputWhenItIsAValidTld($input)
    {
        $rule = new Tld();

        $this->assertTrue($rule->validate($input));
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
    public function testShouldInvalidateInputWhenItIsNotAValidTld($input)
    {
        $rule = new Tld();

        $this->assertFalse($rule->validate($input));
    }
}
