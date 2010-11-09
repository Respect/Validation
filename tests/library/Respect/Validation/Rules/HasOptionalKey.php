<?php

namespace Respect\Validation\Rules;

class HasOptionalKeyTest extends \PHPUnit_Framework_TestCase
{

    public function testHasOptionalKey()
    {
        $validator = new HasOptionalKey('bar');
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    public function testNotNull()
    {
        $validator = new HasOptionalKey('bar');
        $obj = array();
        $obj['baraaaaaa'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters()
    {
        $validator = new HasOptionalKey(array('invalid'));
    }

    public function testValidatorAttribute()
    {
        $subValidator = new StringLength(1, 3);
        $validator = new HasOptionalKey('bar', $subValidator);
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

}