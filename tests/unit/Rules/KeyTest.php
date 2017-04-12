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
 * @covers \Respect\Validation\Rules\Key
 * @covers \Respect\Validation\Exceptions\KeyException
 */
class KeyTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayWithPresentKeyShouldReturnTrue()
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['bar'] = 'foo';
        $this->assertTrue($validator->validate($someArray));
    }

    public function testArrayWithNumericKeyShouldReturnTrue()
    {
        $validator = new Key(0);
        $someArray = [];
        $someArray[0] = 'foo';
        $this->assertTrue($validator->validate($someArray));
    }

    public function testEmptyInputMustReturnFalse()
    {
        $validator = new Key('someEmptyKey');
        $input = '';

        $this->assertFalse($validator->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testEmptyInputMustNotAssert()
    {
        $validator = new Key('someEmptyKey');
        $validator->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testEmptyInputMustNotCheck()
    {
        $validator = new Key('someEmptyKey');
        $validator->check('');
    }

    public function testArrayWithEmptyKeyShouldReturnTrue()
    {
        $validator = new Key('someEmptyKey');
        $input = [];
        $input['someEmptyKey'] = '';

        $this->assertTrue($validator->validate($input));
    }

    public function testShouldHaveTheSameReturnValueForAllValidators()
    {
        $rule = new Key('key', new NotEmpty());
        $input = ['key' => ''];

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
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testArrayWithAbsentKeyShouldThrowKeyException()
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['baraaaaaa'] = 'foo';
        $this->assertTrue($validator->assert($someArray));
    }
    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testNotArrayShouldThrowKeyException()
    {
        $validator = new Key('bar');
        $someArray = 123;
        $this->assertFalse($validator->assert($someArray));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParametersShouldThrowComponentExceptionUponInstantiation()
    {
        $validator = new Key(['invalid']);
    }

    public function testExtraValidatorShouldValidateKey()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $someArray = [];
        $someArray['bar'] = 'foo';
        $this->assertTrue($validator->assert($someArray));
    }

    public function testNotMandatoryExtraValidatorShouldPassWithAbsentKey()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $someArray = [];
        $this->assertTrue($validator->validate($someArray));
    }
}
