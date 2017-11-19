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
 * @covers \Respect\Validation\Rules\StartsWith
 * @covers \Respect\Validation\Exceptions\StartsWithException
 */
class StartsWithTest extends TestCase
{
    /**
     * @dataProvider providerForStartsWith
     */
    public function testStartsWith($start, $input): void
    {
        $v = new StartsWith($start);
        self::assertTrue($v->__invoke($input));
        self::assertTrue($v->check($input));
        self::assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotStartsWith
     * @expectedException \Respect\Validation\Exceptions\StartsWithException
     */
    public function testNotStartsWith($start, $input, $caseSensitive = false): void
    {
        $v = new StartsWith($start, $caseSensitive);
        self::assertFalse($v->__invoke($input));
        self::assertFalse($v->assert($input));
    }

    public function providerForStartsWith()
    {
        return [
            ['foo', ['foo', 'bar']],
            ['foo', 'FOObarbaz'],
            ['foo', 'foobarbaz'],
            ['foo', 'foobazfoo'],
            ['1', [1, 2, 3]],
            ['1', ['1', 2, 3], true],
        ];
    }

    public function providerForNotStartsWith()
    {
        return [
            ['foo', ''],
            ['bat', ['foo', 'bar']],
            ['foo', 'barfaabaz'],
            ['foo', 'FOObarbaz', true],
            ['foo', 'faabarbaz'],
            ['foo', 'baabazfaa'],
            ['foo', 'baafoofaa'],
            ['1', [1, '1', 3], true],
        ];
    }
}
