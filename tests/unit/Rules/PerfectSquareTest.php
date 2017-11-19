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
 * @covers \Respect\Validation\Rules\PerfectSquare
 * @covers \Respect\Validation\Exceptions\PerfectSquareException
 */
class PerfectSquareTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new PerfectSquare();
    }

    /**
     * @dataProvider providerForPerfectSquare
     */
    public function testPerfectSquare($input): void
    {
        self::assertTrue($this->object->__invoke($input));
        self::assertTrue($this->object->check($input));
        self::assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPerfectSquare
     * @expectedException \Respect\Validation\Exceptions\PerfectSquareException
     */
    public function testNotPerfectSquare($input): void
    {
        self::assertFalse($this->object->__invoke($input));
        self::assertFalse($this->object->assert($input));
    }

    public function providerForPerfectSquare()
    {
        return [
            [1],
            [9],
            [25],
            ['25'],
            [400],
            ['400'],
            ['0'],
            [81],
            [0],
            [2500],
        ];
    }

    public function providerForNotPerfectSquare()
    {
        return [
            [250],
            [''],
            [null],
            [7],
            [-1],
            [6],
            [2],
            ['-1'],
            ['a'],
            [' '],
            ['Foo'],
        ];
    }
}
