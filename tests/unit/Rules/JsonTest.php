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
 * @covers Respect\Validation\Rules\Json
 * @covers Respect\Validation\Exceptions\JsonException
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{
    protected $json;

    protected function setUp()
    {
        $this->json = new Json();
    }

    /**
     * @dataProvider providerForPass
     */
    public function testValidJsonsShouldReturnTrue($input)
    {
        $this->assertTrue($this->json->__invoke($input));
        $this->assertTrue($this->json->check($input));
        $this->assertTrue($this->json->assert($input));
    }

    /**
     * @dataProvider providerForNotPass
     */
    public function testInvalidJsonsShouldReturnFalse($input)
    {
        $this->assertFalse($this->json->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\JSonException
     */
    public function testInvalidJsonsShouldThrowJsonException()
    {
        $this->assertFalse($this->json->__invoke('{foo:bar}'));
        $this->assertFalse($this->json->assert('{foo:bar}'));
    }

    public function testInvalidJsonsNotBeValid()
    {
        $this->assertFalse($this->json->validate(''));
    }

    public function providerForPass()
    {
        return array(
            array('[1,2,3]'),
            array('["foo", "bar", "number", 1]'),
            array('{"foo": "bar", "number":1}'),
            array('[]'),
            array('{}'),
        );
    }

    public function providerForNotPass()
    {
        return array(
            array('2'),
            array('"abc"'),
            array('false'),
            array('null'),
        );
    }
}
