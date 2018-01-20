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
 * @covers \Respect\Validation\Rules\Odd
 * @covers \Respect\Validation\Exceptions\OddException
 */
class OddTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new Odd();
    }

    /**
     * @dataProvider providerForOdd
     */
    public function testOdd($input): void
    {
        self::assertTrue($this->object->assert($input));
        self::assertTrue($this->object->__invoke($input));
        self::assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotOdd
     * @expectedException \Respect\Validation\Exceptions\OddException
     */
    public function testNotOdd($input): void
    {
        self::assertFalse($this->object->__invoke($input));
        self::assertFalse($this->object->assert($input));
    }

    public function providerForOdd()
    {
        return [
            [-5],
            [-1],
            [1],
            [13],
        ];
    }

    public function providerForNotOdd()
    {
        return [
            [''],
            [-2],
            [-0],
            [0],
            [32],
        ];
    }
}
