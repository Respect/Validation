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
 * @covers \Respect\Validation\Rules\ObjectType
 * @covers \Respect\Validation\Exceptions\ObjectTypeException
 */
class ObjectTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new ObjectType();
    }

    /**
     * @dataProvider providerForObject
     */
    public function testObject($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotObject
     * @expectedException \Respect\Validation\Exceptions\ObjectTypeException
     */
    public function testNotObject($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
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
