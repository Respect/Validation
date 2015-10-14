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

use stdClass;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\NotBlank
 * @covers Respect\Validation\Exceptions\NotBlankException
 */
class NotBlankTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForNotBlank
     */
    public function testShouldValidateWhenNotBlank($input)
    {
        $rule = new NotBlank();

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForBlank
     */
    public function testShouldNotValidateWhenBlank($input)
    {
        $rule = new NotBlank();

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotBlankException
     * @expectedExceptionMessage The value must not be blank
     */
    public function testShouldThrowExceptionWhenFailure()
    {
        $rule = new NotBlank();
        $rule->check(0);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotBlankException
     * @expectedExceptionMessage whatever must not be blank
     */
    public function testShouldThrowExceptionWhenFailureAndDoesHaveAName()
    {
        $rule = new NotBlank();
        $rule->setName('whatever');
        $rule->check(0);
    }

    public function providerForNotBlank()
    {
        $object = new stdClass();
        $object->foo = true;

        return array(
            array(1),
            array(' oi'),
            array(array(5)),
            array(array(1)),
            array($object),
        );
    }

    public function providerForBlank()
    {
        return array(
            array(null),
            array(''),
            array(array()),
            array(' '),
            array(0),
            array('0'),
            array(0),
            array('0.0'),
            array(false),
            array(array('')),
            array(array(' ')),
            array(array(0)),
            array(array('0')),
            array(array(false)),
            array(array(array(''), array(0))),
            array(new stdClass()),
        );
    }
}
