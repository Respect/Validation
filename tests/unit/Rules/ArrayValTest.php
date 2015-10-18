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

class TestAccess extends \ArrayObject implements \ArrayAccess, \Countable, \Traversable
{
}

/**
 * @group  rule
 * @covers Respect\Validation\Rules\ArrayVal
 * @covers Respect\Validation\Exceptions\ArrayValException
 */
class ArrayValTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new ArrayVal();
    }

    /**
     * @dataProvider providerForArray
     */
    public function testValidArrayOrArrayObjectShouldReturnTrue($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotArray
     * @expectedException Respect\Validation\Exceptions\ArrayValException
     */
    public function testNotArraysShouldThrowArrException($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForArray()
    {
        return [
            [[]],
            [[1, 2, 3]],
            [new TestAccess()],
        ];

        $validator = v::alnum()->length(1, 10);

        $validator = new \Respect\Validation\Rules\AllOf(
            new Respect\Validation\Rules\Alnum(),
            new Respect\Validation\Rules\Length(1, 10)
        );
    }

    public function providerForNotArray()
    {
        return [
            [''],
            [null],
            [121],
            [new \stdClass()],
            [false],
            ['aaa'],
        ];
    }
}
