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
 * @covers Respect\Validation\Rules\Contains
 * @covers Respect\Validation\Exceptions\ContainsException
 */
class ContainsTest extends TestCase
{
    /**
     * @dataProvider providerForContainsIdentical
     */
    public function testStringsContainingExpectedIdenticalValueShouldPass($start, $input)
    {
        $v = new Contains($start, true);
        $this->assertTrue($v->validate($input));
    }

    /**
     * @dataProvider providerForContains
     */
    public function testStringsContainingExpectedValueShouldPass($start, $input)
    {
        $v = new Contains($start, false);
        $this->assertTrue($v->validate($input));
    }

    /**
     * @dataProvider providerForNotContainsIdentical
     */
    public function testStringsNotContainsExpectedIdenticalValueShouldNotPass($start, $input)
    {
        $v = new Contains($start, true);
        $this->assertFalse($v->validate($input));
    }

    /**
     * @dataProvider providerForNotContains
     */
    public function testStringsNotContainsExpectedValueShouldNotPass($start, $input)
    {
        $v = new Contains($start, false);
        $this->assertFalse($v->validate($input));
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
