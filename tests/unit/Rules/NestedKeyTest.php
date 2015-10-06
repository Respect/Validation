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
            'bar' => array(
                'foo'   => array(
                    'baz' => 'hello world!',
                ),
                'foooo' => array(
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

    public function testArrayWithPresentKeyContainingADotSignWillReturnTrue()
    {
        $pathValidator = new NestedKey('bar.foo');
        $obj = array(
            'bar.foo' => 'hello world!',
        );

        $this->assertTrue($pathValidator->assert($obj));
        $this->assertTrue($pathValidator->check($obj));
        $this->assertTrue($pathValidator->validate($obj));

        $subValidator = new Equals('hello world!');
        $validator = new NestedKey('bar.foo', $subValidator);

        $this->assertTrue($validator->assert($obj));
        $this->assertTrue($validator->check($obj));
        $this->assertTrue($validator->validate($obj));
    }

    public function testObjectWithPresentPropertiesWillReturnTrue()
    {
        $fullPathValidator = new NestedKey('bar.foo.baz');
        $halfPathValidator = new NestedKey('bar.foo');
        $dirtyPathValidator = new NestedKey('bar.foooo.');
        $obj = (object) array(
            'bar' => (object) array(
                'foo'   => (object) array(
                    'baz' => 'hello world!',
                ),
                'foooo' => (object) array(
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

    public function testEmptyInputMustReturnTrue()
    {
        $fullPathValidator = new NestedKey('bar.foo.baz');
        $halfPathValidator = new NestedKey('bar.foo');
        $dirtyPathValidator = new NestedKey('bar.foooo.');
        $obj = '';

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

    public function testArrayWithEmptyKeyShouldReturnTrue()
    {
        $pathValidator = new NestedKey('emptyKey');
        $dirtyPathValidator = new NestedKey('emptyKey.');
        $input = array();
        $input['emptyKey'] = '';

        $this->assertTrue($pathValidator->assert($input));
        $this->assertTrue($pathValidator->check($input));
        $this->assertTrue($pathValidator->validate($input));

        $this->assertTrue($dirtyPathValidator->assert($input));
        $this->assertTrue($dirtyPathValidator->check($input));
        $this->assertTrue($dirtyPathValidator->validate($input));
    }

    public function testShouldHaveTheSameReturnValueForAllValidators()
    {
        $rule = new NestedKey('key1.key2', new NotEmpty());
        $input = (object) array('key1' => array('key2' => ''));

        try {
            $rule->assert($input);
            $this->fail('`assert()` must throws exception');
        } catch (\Exception $e) {
        }

        try {
            $rule->check($input);
            $this->fail('`check()` must throws exception');
        } catch (\Exception $e) {
        }

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\NestedKeyException
     */
    public function testArrayWithAbsentKeyShouldThrowNestedKeyException()
    {
        $validator = new NestedKey('bar.bar');
        $obj = array(
            'baraaaaaa' => array(
                'bar' => 'foo',
            ),
        );
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\NestedKeyException
     */
    public function testNotArrayShouldThrowKeyException()
    {
        $validator = new NestedKey('baz.bar');
        $obj = 123;
        $this->assertFalse($validator->assert($obj));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParametersShouldThrowComponentExceptionUponInstantiation()
    {
        $validator = new NestedKey(array('invalid'));
    }

    public function testExtraValidatorShouldValidateKey()
    {
        $subValidator = new Length(3, 7);
        $validator = new NestedKey('bar.foo.baz', $subValidator);
        $obj = array(
            'bar' => array(
                'foo'   => array(
                    'baz' => 'example',
                ),
            ),
        );
        $this->assertTrue($validator->assert($obj));
    }

    public function testNotMandatoryExtraValidatorShouldPassWithAbsentKey()
    {
        $subValidator = new Length(1, 3);
        $validator = new NestedKey('bar.rab', $subValidator, false);
        $obj = new \stdClass();
        $this->assertTrue($validator->validate($obj));
    }
}
