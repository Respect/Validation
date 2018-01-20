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
 * @covers \Respect\Validation\Rules\Negative
 * @covers \Respect\Validation\Exceptions\NegativeException
 */
class NegativeTest extends TestCase
{
    protected $negativeValidator;

    protected function setUp(): void
    {
        $this->negativeValidator = new Negative();
    }

    /**
     * @dataProvider providerForNegative
     */
    public function testNegativeShouldPass($input): void
    {
        self::assertTrue($this->negativeValidator->assert($input));
        self::assertTrue($this->negativeValidator->__invoke($input));
        self::assertTrue($this->negativeValidator->check($input));
    }

    /**
     * @dataProvider providerForNotNegative
     * @expectedException \Respect\Validation\Exceptions\NegativeException
     */
    public function testNotNegativeNumbersShouldThrowNegativeException($input): void
    {
        self::assertFalse($this->negativeValidator->__invoke($input));
        self::assertFalse($this->negativeValidator->assert($input));
    }

    public function providerForNegative()
    {
        return [
            ['-1.44'],
            [-1e-5],
            [-10],
        ];
    }

    public function providerForNotNegative()
    {
        return [
            [''],
            [0],
            [-0],
            [null],
            ['a'],
            [' '],
            ['Foo'],
            [16],
            ['165'],
            [123456],
            [1e10],
        ];
    }
}
