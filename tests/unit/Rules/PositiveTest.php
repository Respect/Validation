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
 * @covers \Respect\Validation\Rules\Positive
 * @covers \Respect\Validation\Exceptions\PositiveException
 */
class PositiveTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new Positive();
    }

    /**
     * @dataProvider providerForPositive
     */
    public function testPositive($input): void
    {
        self::assertTrue($this->object->__invoke($input));
        self::assertTrue($this->object->check($input));
        self::assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPositive
     * @expectedException \Respect\Validation\Exceptions\PositiveException
     */
    public function testNotPositive($input): void
    {
        self::assertFalse($this->object->__invoke($input));
        self::assertFalse($this->object->assert($input));
    }

    public function providerForPositive()
    {
        return [
            [16],
            ['165'],
            [123456],
            [1e10],
        ];
    }

    public function providerForNotPositive()
    {
        return [
            [''],
            [null],
            ['a'],
            [' '],
            ['Foo'],
            ['-1.44'],
            [-1e-5],
            [0],
            [-0],
            [-10],
        ];
    }
}
