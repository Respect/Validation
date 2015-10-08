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
 * @covers Respect\Validation\Rules\NotEmpty
 * @covers Respect\Validation\Exceptions\NotEmptyException
 */
class NotEmptyTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NotEmpty();
    }

    /**
     * @dataProvider providerForNotEmpty
     */
    public function testStringNotEmpty($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForEmpty
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testStringEmpty($input)
    {
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNotEmpty()
    {
        return array(
            array(1),
            array(' oi'),
            array('0'),
            array(array(5)),
            array(array(0)),
            array(new \stdClass()),
        );
    }

    public function providerForEmpty()
    {
        return array(
            array(''),
            array('    '),
            array("\n"),
            array(false),
            array(null),
            array(array()),
        );
    }
}
