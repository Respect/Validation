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
 * @covers \Respect\Validation\Rules\NullType
 * @covers \Respect\Validation\Exceptions\NullTypeException
 */
class NullTypeTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new NullType();
    }

    public function testNullValue(): void
    {
        self::assertTrue($this->object->assert(null));
        self::assertTrue($this->object->__invoke(null));
        self::assertTrue($this->object->check(null));
    }

    /**
     * @dataProvider providerForNotNull
     * @expectedException \Respect\Validation\Exceptions\NullTypeException
     */
    public function testNotNull($input): void
    {
        self::assertFalse($this->object->__invoke($input));
        self::assertFalse($this->object->assert($input));
    }

    public function providerForNotNull()
    {
        return [
            [''],
            [0],
            ['w poiur'],
            [' '],
            ['Foo'],
        ];
    }
}
