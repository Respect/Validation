<?php

namespace Respect\Validation\Rules;

class KeyTest extends \PHPUnit_Framework_TestCase
{

    public function testKey()
    {
        $validator = new Key('bar');
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\KeyException
     */
    public function testNotNull()
    {
        $validator = new Key('bar');
        $obj = array();
        $obj['baraaaaaa'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\KeyException
     */
    public function testNotArray()
    {
        $validator = new Key('bar');
        $obj = 123;
        $this->assertFalse($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters()
    {
        $validator = new Key(array('invalid'));
    }

    public function testValidatorAttribute()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    public function testNotMandatory()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $obj = array();
        $this->assertTrue($validator->validate($obj));
    }

}