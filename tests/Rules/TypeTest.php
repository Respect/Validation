<?php
namespace Respect\Validation\Rules;

use stdClass;

class TypeTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldDefineTypeOnConstructor()
    {
        $type   = 'int';
        $rule   = new Type($type);

        $this->assertSame($type, $rule->type);
    }

    public function testShouldNotBeCaseSensitive()
    {
        $rule   = new Type('InTeGeR');

        $this->assertTrue($rule->validate(42));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid type
     */
    public function testShouldThrowExceptionWhenTypeIsNotValid()
    {
        new Type('whatever');
    }

    /**
     * @dataProvider providerForValidType
     */
    public function testShouldValidateValidTypes($type, $input)
    {
        $rule = new Type($type);

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForInvalidType
     */
    public function testShouldNotValidateInvalidTypes($type, $input)
    {
        $rule = new Type($type);

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\TypeException
     * @expectedExceptionMessage "Something" must be integer
     */
    public function testShouldThrowTypeExceptionWhenCheckingAnInvalidInput()
    {
        $rule = new Type('integer');
        $rule->check('Something');
    }

    public function providerForValidType()
    {
        return array(
            array('array', array()),
            array('bool', true),
            array('boolean', false),
            array('callable', function () {}),
            array('double', 0.8),
            array('float', 1.0),
            array('int', 42),
            array('integer', 13),
            array('null', null),
            array('object', new stdClass()),
            array('resource', tmpfile()),
            array('string', 'Something'),
        );
    }

    public function providerForInvalidType()
    {
        return array(
            array('int', '1'),
            array('bool', '1'),
        );
    }
}
