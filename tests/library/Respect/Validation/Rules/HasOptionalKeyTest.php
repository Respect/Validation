<?php

namespace Respect\Validation\Rules;

class HasOptionalKeyTest extends \PHPUnit_Framework_TestCase
{


    public function testValidatorAttribute()
    {
        $subValidator = new StringLength(1, 3);
        $validator = new HasOptionalKey('bar', $subValidator);
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

}