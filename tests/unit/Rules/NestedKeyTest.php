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

use Respect\Validation\Validator;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\NestedKey
 * @covers Respect\Validation\Exceptions\NestedKeyException
 */
class NestedKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayWithPresentKeysWillReturnTrue()
    {
        $fullPathValidator = new NestedKey('bar.foo.baz');
        $halfPathValidator = new NestedKey('bar.foo');
        $dirtyPathValidator = new NestedKey('bar.foooo.');
        $obj = array(
            'bar' => array (
                'foo' => array (
                    'baz' => 'hello world!',
                ),
                'foooo' => array (
                    'boooo' => 321,
                ),
            ),
        );

        $this->assertTrue($fullPathValidator->assert($obj));
        $this->assertTrue($fullPathValidator->check($obj));
        $this->assertTrue($fullPathValidator->validate($obj));

        $this->assertTrue($halfPathValidator->assert($obj));
        $this->assertTrue($halfPathValidator->check($obj));
        $this->assertTrue($halfPathValidator->validate($obj));

        $this->assertTrue($dirtyPathValidator->assert($obj));
        $this->assertTrue($dirtyPathValidator->check($obj));
        $this->assertTrue($dirtyPathValidator->validate($obj));
    }

    public function testObjectWithPresentPropertiesWillReturnTrue()
    {
        $fullPathValidator = new NestedKey('bar.foo.baz');
        $halfPathValidator = new NestedKey('bar.foo');
        $dirtyPathValidator = new NestedKey('bar.foooo.');
        $obj = (object) array(
            'bar' => (object) array (
                'foo' => (object) array (
                    'baz' => 'hello world!',
                ),
                'foooo' => (object) array (
                    'boooo' => 321,
                ),
            ),
        );

        $this->assertTrue($fullPathValidator->assert($obj));
        $this->assertTrue($fullPathValidator->check($obj));
        $this->assertTrue($fullPathValidator->validate($obj));

        $this->assertTrue($halfPathValidator->assert($obj));
        $this->assertTrue($halfPathValidator->check($obj));
        $this->assertTrue($halfPathValidator->validate($obj));

        $this->assertTrue($dirtyPathValidator->assert($obj));
        $this->assertTrue($dirtyPathValidator->check($obj));
        $this->assertTrue($dirtyPathValidator->validate($obj));
    }
}
