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
 * @covers Respect\Validation\Rules\Countable
 */
class CountableTest extends \PHPUnit_Framework_TestCase
{
    public function providerForValidCountable()
    {
        return array(
            array(array()),
            array(new \ArrayObject()),
            array(new \ArrayIterator()),
        );
    }

    /**
     * @dataProvider providerForValidCountable
     */
    public function testShouldValidateInputWhenItIsAValidCountable($input)
    {
        $rule = new Countable();

        $this->assertTrue($rule->validate($input));
    }

    public function providerForInvalidCountable()
    {
        return array(
            array('1'),
            array(1.0),
            array(PHP_INT_MAX),
            array(true)
        );
    }

    /**
     * @dataProvider providerForInvalidCountable
     */
    public function testShouldInvalidateInputWhenItIsNotAValidCountable($input)
    {
        $rule = new Countable();

        $this->assertFalse($rule->validate($input));
    }
}
