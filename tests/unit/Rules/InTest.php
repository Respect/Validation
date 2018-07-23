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
 * @covers \Respect\Validation\Exceptions\InException
 * @covers \Respect\Validation\Rules\In
 */
class InTest extends TestCase
{
    /**
     * @dataProvider providerForIn
     *
     * @test
     */
    public function successInValidatorCases($input, $options = null): void
    {
        $v = new In($options);
        self::assertTrue($v->__invoke($input));
        $v->check($input);
        $v->assert($input);
    }

    /**
     * @dataProvider providerForNotIn
     * @expectedException \Respect\Validation\Exceptions\InException
     *
     * @test
     */
    public function invalidInChecksShouldThrowInException($input, $options, $strict = false): void
    {
        $v = new In($options, $strict);
        self::assertFalse($v->__invoke($input));
        $v->assert($input);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InException
     * @expectedExceptionMessage "x" must be in `{ "foo", "bar" }`
     *
     * @test
     */
    public function inCheckExceptionMessageWithArray(): void
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
