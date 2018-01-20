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
 * @covers \Respect\Validation\Rules\ObjectType
 * @covers \Respect\Validation\Exceptions\ObjectTypeException
 */
class ObjectTypeTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new ObjectType();
    }

    /**
     * @dataProvider providerForObject
     */
    public function testObject($input): void
    {
        self::assertTrue($this->object->__invoke($input));
        self::assertTrue($this->object->assert($input));
        self::assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotObject
     * @expectedException \Respect\Validation\Exceptions\ObjectTypeException
     */
    public function testNotObject($input): void
    {
        self::assertFalse($this->object->__invoke($input));
        self::assertFalse($this->object->assert($input));
    }

    public function providerForObject()
    {
        return [
            [new \stdClass()],
            [new \ArrayObject()],
        ];
    }

    public function providerForNotObject()
    {
        return [
            [''],
            [null],
            [121],
            [[]],
            ['Foo'],
            [false],
        ];
    }
}
