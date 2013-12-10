<?php
namespace Respect\Validation\Rules;

class CallbackTest extends \PHPUnit_Framework_TestCase
{
    private $truthy, $falsy;

    function setUp() {
        $this->truthy = new Callback(function() {
            return true;
        });
        $this->falsy = new Callback(function() {
            return false;
        });
    }

    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return true;
    }

    public function testCallbackValidatorShouldReturnTrueForEmptyString()
    {
        $this->assertTrue($this->truthy->assert(''));
        $this->assertTrue($this->falsy->assert(''));
    }

    public function testCallbackValidatorShouldReturnTrueIfCallbackReturnsTrue()
    {
        $this->assertTrue($this->truthy->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackValidatorShouldReturnFalseIfCallbackReturnsFalse()
    {
        $this->assertTrue($this->falsy->assert('w poiur'));
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

