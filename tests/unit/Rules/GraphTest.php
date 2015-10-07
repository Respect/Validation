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
 * @covers Respect\Validation\Rules\Graph
 * @covers Respect\Validation\Exceptions\GraphException
 */
class GraphTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidGraph
     */
    public function testValidDataWithGraphCharsShouldReturnTrue($validGraph, $additional = '')
    {
        $validator = new Graph($additional);
        $this->assertTrue($validator->validate($validGraph));
    }

    /**
     * @dataProvider providerForInvalidGraph
     * @expectedException Respect\Validation\Exceptions\GraphException
     */
    public function testInvalidGraphShouldFailAndThrowGraphException($invalidGraph, $additional = '')
    {
        $validator = new Graph($additional);
        $this->assertFalse($validator->validate($invalidGraph));
        $this->assertFalse($validator->assert($invalidGraph));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Graph($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Graph($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array(' ', '!@#$%^&*(){} abc 123'),
            array(" \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"),
        );
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass()),
            array(array()),
            array(0x2),
        );
    }

    public function providerForValidGraph()
    {
        return array(
            array('LKA#@%.54'),
            array('foobar'),
            array('16-50'),
            array('123'),
            array('#$%&*_'),
        );
    }

    public function providerForInvalidGraph()
    {
        return array(
            array(''),
            array(null),
            array("foo\nbar"),
            array("foo\tbar"),
            array('foo bar'),
            array(' '),
        );
    }
}
