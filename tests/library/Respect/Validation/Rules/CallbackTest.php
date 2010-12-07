<?php

namespace Respect\Validation\Rules;

class CallbackTest extends \PHPUnit_Framework_TestCase
{

    public function callbackThis()
    {
        return true;
    }

    public function testCallbackOk()
    {
        $v = new Callback(function() {
                    return true;
                });
        $this->assertTrue($v->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackNot()
    {
        $v = new Callback(function() {
                    return false;
                });
        $this->assertTrue($v->assert('w poiur'));
    }

    public function testCallbackObject()
    {
        $v = new Callback(array($this, 'callbackThis'));
        $this->assertTrue($v->assert('test'));
    }

    public function testCallbackString()
    {
        $v = new Callback('is_string');
        $this->assertTrue($v->assert('test'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters()
    {
        $v = new Callback(new \stdClass);
        $this->assertTrue($v->assert('w poiur'));
    }

}