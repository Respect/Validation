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
 * @covers \Respect\Validation\Rules\FloatVal
 * @covers \Respect\Validation\Exceptions\FloatValException
 */
class FloatValTest extends TestCase
{
    protected $floatValidator;

    protected function setUp(): void
    {
        $this->floatValidator = new FloatVal();
    }

    /**
     * @dataProvider providerForFloat
     */
    public function testFloatNumbersShouldPass($input): void
    {
        self::assertTrue($this->floatValidator->assert($input));
        self::assertTrue($this->floatValidator->__invoke($input));
        self::assertTrue($this->floatValidator->check($input));
    }

    /**
     * @dataProvider providerForNotFloat
     * @expectedException \Respect\Validation\Exceptions\FloatValException
     */
    public function testNotFloatNumbersShouldFail($input): void
    {
        self::assertFalse($this->floatValidator->__invoke($input));
        self::assertFalse($this->floatValidator->assert($input));
    }

    public function providerForFloat()
    {
        return [
            [165],
            [1],
            [0],
            [0.0],
            ['1'],
            ['19347e12'],
            [165.0],
            ['165.7'],
            [1e12],
        ];
    }

    public function providerForNotFloat()
    {
        return [
            [''],
            [null],
            ['a'],
            [' '],
            ['Foo'],
        ];
    }
}
