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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\In
 * @covers Respect\Validation\Exceptions\InException
 */
class InTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForIn
     */
    public function testSuccessInValidatorCases($input, $options = null)
    {
        $v = new In($options);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotIn
     * @expectedException Respect\Validation\Exceptions\InException
     */
    public function testInvalidInChecksShouldThrowInException($input, $options, $strict = false)
    {
        $v = new In($options, $strict);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InException
     * @expectedExceptionMessage "x" must be in { "foo", "bar" }
     */
    public function testInCheckExceptionMessageWithArray()
    {
        $v = new In(['foo', 'bar']);
        $v->assert('x');
    }

    public function providerForIn()
    {
        return [
            ['', ['']],
            [null, [null]],
            ['0', ['0']],
            [0, [0]],
            ['foo', ['foo', 'bar']],
            ['foo', 'barfoobaz'],
            ['foo', 'foobarbaz'],
            ['foo', 'barbazfoo'],
            ['1', [1, 2, 3]],
            ['1', ['1', 2, 3], true],
        ];
    }

    public function providerForNotIn()
    {
        return [
            [null, '0'],
            [null, 0, true],
            [null, '', true],
            [null, []],
            ['', 'barfoobaz'],
            [null, 'barfoobaz'],
            [0, 'barfoobaz'],
            ['0', 'barfoobaz'],
            ['bat', ['foo', 'bar']],
            ['foo', 'barfaabaz'],
            ['foo', 'faabarbaz'],
            ['foo', 'baabazfaa'],
            ['1', [1, 2, 3], true],
        ];
    }
}
