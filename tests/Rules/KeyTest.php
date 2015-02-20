<?php
namespace Respect\Validation\Rules;

class KeyTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayWithPresentKeyShouldReturnTrue()
    {
        $validator = new Key('bar');
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
        $this->assertTrue($validator->check($obj));
        $this->assertTrue($validator->validate($obj));
    }

    public function testEmptyInputMustReturnTrue()
    {
        $validator = new Key('someEmptyKey');
        $input = '';

        $this->assertTrue($validator->assert($input));
        $this->assertTrue($validator->check($input));
        $this->assertTrue($validator->validate($input));
    }

    public function testArrayWithEmptyKeyShouldReturnTrue()
    {
        $validator = new Key('someEmptyKey');
        $input = array();
        $input['someEmptyKey'] = '';

        $this->assertTrue($validator->assert($input));
        $this->assertTrue($validator->check($input));
        $this->assertTrue($validator->validate($input));
    }

    public function testShouldHaveTheSameReturnValueForAllValidators()
    {
        $rule   = new Key('key', new NotEmpty());
        $input  = array('key' => '');

        try {
            $rule->assert($input);
            $this->fail('`assert()` must throws exception');
        } catch (\Exception $e) {}

        try {
            $rule->check($input);
            $this->fail('`check()` must throws exception');
        } catch (\Exception $e) {}

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\KeyException
     */
    public function testArrayWithAbsentKeyShouldThrowKeyException()
    {
        $validator = new Key('bar');
        $obj = array();
        $obj['baraaaaaa'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\KeyException
     */
    public function testNotArrayShouldThrowKeyException()
    {
        $validator = new Key('bar');
        $obj = 123;
        $this->assertFalse($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParametersShouldThrowComponentExceptionUponInstantiation()
    {
        $validator = new Key(array('invalid'));
    }

    public function testExtraValidatorShouldValidateKey()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    public function testNotMandatoryExtraValidatorShouldPassWithAbsentKey()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $obj = array();
        $this->assertTrue($validator->validate($obj));
    }
}

