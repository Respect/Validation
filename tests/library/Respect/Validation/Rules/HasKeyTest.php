<?php

namespace Respect\Validation\Rules;

class HasKeyTest extends \PHPUnit_Framework_TestCase
{

    public function testHasKey()
    {
        $validator = new HasKey('bar');
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotNull()
    {
        $validator = new HasKey('bar');
        $obj = array();
        $obj['baraaaaaa'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters()
    {
        $validator = new HasKey(array('invalid'));
    }

    public function testValidatorAttribute()
    {
        $subValidator = new StringLength(1, 3);
        $validator = new HasKey('bar', $subValidator);
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

}