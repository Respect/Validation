<?php
namespace Respect\Validation\Rules;

class CallbackTest extends \PHPUnit_Framework_TestCase
{
    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return true;
    }

    public function testCallbackValidatorShouldReturnTrueIfCallbackReturnsTrue()
    {
        $v = new Callback(function() {
                    return true;
                });
        $this->assertTrue($v->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackValidatorShouldReturnFalseIfCallbackReturnsFalse()
    {
        $v = new Callback(function() {
                    return false;
                });
        $this->assertTrue($v->assert('w poiur'));
    }

    public function testCallbackValidatorShouldAcceptArrayCallbackDefinitions()
    {
        $v = new Callback(array($this, 'thisIsASampleCallbackUsedInsideThisTest'));
        $this->assertTrue($v->assert('test'));
    }

    public function testCallbackValidatorShouldAcceptFunctionNamesAsString()
    {
        $v = new Callback('is_string');
        $this->assertTrue($v->assert('test'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidCallbacksShouldRaiseComponentExceptionUponInstantiation()
    {
        $v = new Callback(new \stdClass);
        $this->assertTrue($v->assert('w poiur'));
    }
}

