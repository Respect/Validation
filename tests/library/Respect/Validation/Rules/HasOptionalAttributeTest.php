<?php

namespace Respect\Validation\Rules;

class HasOptionalAttributeTest extends \PHPUnit_Framework_TestCase
{

    public function testValidatorAttribute()
    {
        $subValidator = new StringLength(1, 10);
        $validator = new HasOptionalAttribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

}