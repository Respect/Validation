<?php

namespace Respect\Validation\Rules;

class PrivClass
{

    private $bar = 'foo';

}

class AttributeTest extends \PHPUnit_Framework_TestCase
{

    public function testAttribute()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\AttributeException
     */
    public function testNotNull()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass;
        $obj->baraaaaa = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @dataProvider providerForInvalidAtrributeNames
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters($attributeName)
    {
        $validator = new Attribute($attributeName);
    }

    public function providerForInvalidAtrributeNames()
    {
        return array(
            array(new \stdClass),
            array(123),
            array('')
        );
    }

    public function testValidatorAttribute()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    public function testValidatorPrivateAttribute()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new PrivClass;
        $this->assertTrue($validator->assert($obj));
    }

}