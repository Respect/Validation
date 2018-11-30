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
 * @covers Respect\Validation\Rules\EndsWith
 * @covers Respect\Validation\Exceptions\EndsWithException
 */
class EndsWithTest extends TestCase
{
    /**
     * @dataProvider providerForEndsWith
     */
    public function testStringsEndingWithExpectedValueShouldPass($start, $input)
    {
        $v = new EndsWith($start);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotEndsWith
     * @expectedException Respect\Validation\Exceptions\EndsWithException
     */
    public function testStringsNotEndingWithExpectedValueShouldNotPass($start, $input, $caseSensitive = false)
    {
        $v = new EndsWith($start, $caseSensitive);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForEndsWith()
    {
        return [
            ['foo', ['bar', 'foo']],
            ['foo', 'barbazFOO'],
            ['foo', 'barbazfoo'],
            ['foo', 'foobazfoo'],
            ['1', [2, 3, 1]],
            ['1', [2, 3, '1'], true],
        ];
    }

    public function providerForNotEndsWith()
    {
        return [
            ['foo', ''],
            ['bat', ['bar', 'foo']],
            ['foo', 'barfaabaz'],
            ['foo', 'barbazFOO', true],
            ['foo', 'faabarbaz'],
            ['foo', 'baabazfaa'],
            ['foo', 'baafoofaa'],
            ['1', [1, '1', 3], true],
        ];
    }
}
