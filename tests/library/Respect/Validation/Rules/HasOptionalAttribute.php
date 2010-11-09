<?php

namespace Respect\Validation\Rules;

class HasOptionalAttributeTest extends \PHPUnit_Framework_TestCase
{

    public function testHasOptionalAttribute()
    {
        $validator = new HasOptionalAttribute('bar');
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    public function testNotNull()
    {
        $validator = new HasOptionalAttribute('bar');
        $obj = new \stdClass;
        $obj->baraaaaa = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters()
    {
        $validator = new HasOptionalAttribute(array('invalid'));
    }

    public function testValidatorAttribute()
    {
        $subValidator = new StringLength(1, 3);
        $validator = new HasOptionalAttribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

}