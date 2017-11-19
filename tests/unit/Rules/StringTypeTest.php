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
 * @covers \Respect\Validation\Rules\StringType
 * @covers \Respect\Validation\Exceptions\StringTypeException
 */
class StringTypeTest extends TestCase
{
    /**
     * @dataProvider providerForString
     */
    public function testString($input): void
    {
        $rule = new StringType();

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotString
     */
    public function testNotString($input): void
    {
        $rule = new StringType();

        self::assertFalse($rule->validate($input));
    }

    public function providerForString()
    {
        return [
            [''],
            ['165.7'],
        ];
    }

    public function providerForNotString()
    {
        return [
            [null],
            [[]],
            [new \stdClass()],
            [150],
        ];
    }
}
