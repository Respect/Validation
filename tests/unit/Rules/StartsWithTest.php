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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\StartsWithException
 * @covers \Respect\Validation\Rules\StartsWith
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class StartsWithTest extends TestCase
{
    /**
     * @dataProvider providerForStartsWith
     *
     * @test
     *
     * @param mixed $input
     */
    public function startsWith(string $start, $input): void
    {
        $v = new StartsWith($start);
        self::assertTrue($v->__invoke($input));
        $v->check($input);
        $v->assert($input);
    }

    /**
     * @dataProvider providerForNotStartsWith
     * @expectedException \Respect\Validation\Exceptions\StartsWithException
     *
     * @test
     *
     * @param mixed $input
     */
    public function notStartsWith(string $start, $input, bool $caseSensitive = false): void
    {
        $v = new StartsWith($start, $caseSensitive);
        self::assertFalse($v->__invoke($input));
        $v->assert($input);
    }

    /**
     * @return mixed[][]
     */
    public function providerForStartsWith(): array
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

    /**
     * @return mixed[][]
     */
    public function providerForNotStartsWith(): array
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
