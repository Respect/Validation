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
 * @covers Respect\Validation\Rules\NullValue
 * @covers Respect\Validation\Exceptions\NullValueException
 */
class NullValueTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NullValue();
    }

    public function testNullValue()
    {
        $this->assertTrue($this->object->assert(null));
        $this->assertTrue($this->object->validate(null));
        $this->assertTrue($this->object->check(null));
    }

    public function testShouldAcceptEmptyStringAsOptionalInput()
    {
        $this->assertTrue($this->object->validate(''));
    }

    /**
     * @dataProvider providerForNotNull
     * @expectedException Respect\Validation\Exceptions\NullValueException
     */
    public function testNotNull($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNotNull()
    {
        return array(
            array(0),
            array('w poiur'),
            array(' '),
            array('Foo'),
        );
    }
}
