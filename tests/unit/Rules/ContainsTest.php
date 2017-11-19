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
 * @covers \Respect\Validation\Rules\Contains
 * @covers \Respect\Validation\Exceptions\ContainsException
 */
class ContainsTest extends TestCase
{
    /**
     * @dataProvider providerForContainsIdentical
     */
    public function testStringsContainingExpectedIdenticalValueShouldPass($start, $input): void
    {
        $v = new Contains($start, true);
        self::assertTrue($v->validate($input));
    }

    /**
     * @dataProvider providerForContains
     */
    public function testStringsContainingExpectedValueShouldPass($start, $input): void
    {
        $v = new Contains($start, false);
        self::assertTrue($v->validate($input));
    }

    /**
     * @dataProvider providerForNotContainsIdentical
     */
    public function testStringsNotContainsExpectedIdenticalValueShouldNotPass($start, $input): void
    {
        $v = new Contains($start, true);
        self::assertFalse($v->validate($input));
    }

    /**
     * @dataProvider providerForNotContains
     */
    public function testStringsNotContainsExpectedValueShouldNotPass($start, $input): void
    {
        $v = new Contains($start, false);
        self::assertFalse($v->validate($input));
    }

    public function providerForContains()
    {
        return [
            ['foo', ['bar', 'foo']],
            ['foo', 'barbazFOO'],
            ['foo', 'barbazfoo'],
            ['foo', 'foobazfoO'],
            ['1', [2, 3, 1]],
            ['1', [2, 3, '1']],
        ];
    }

    public function providerForContainsIdentical()
    {
        return [
            ['foo', ['fool', 'foo']],
            ['foo', 'barbazfoo'],
            ['foo', 'foobazfoo'],
            ['1', [2, 3, (string) 1]],
            ['1', [2, 3, '1']],
        ];
    }

    public function providerForNotContains()
    {
        return [
            ['foo', ''],
            ['bat', ['bar', 'foo']],
            ['foo', 'barfaabaz'],
            ['foo', 'faabarbaz'],
        ];
    }

    public function providerForNotContainsIdentical()
    {
        return [
            ['foo', ''],
            ['bat', ['BAT', 'foo']],
            ['bat', ['BaT', 'Batata']],
            ['foo', 'barfaabaz'],
            ['foo', 'barbazFOO'],
            ['foo', 'faabarbaz'],
        ];
    }
}
