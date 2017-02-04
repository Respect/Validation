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
 * @covers \Respect\Validation\Rules\NullType
 * @covers \Respect\Validation\Exceptions\NullTypeException
 */
class NullTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NullType();
    }

    public function testNullValue()
    {
        $this->assertTrue($this->object->assert(null));
        $this->assertTrue($this->object->__invoke(null));
        $this->assertTrue($this->object->check(null));
    }

    /**
     * @dataProvider providerForNotNull
     * @expectedException \Respect\Validation\Exceptions\NullTypeException
     */
    public function testNotNull($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
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
