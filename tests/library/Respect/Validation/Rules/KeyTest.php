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

