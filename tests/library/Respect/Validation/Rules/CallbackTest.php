<?php

namespace Respect\Validation\Rules;

class CallbackTest extends \PHPUnit_Framework_TestCase
{

    public function testCallbackOk()
    {
        $v = new Callback(function() {
                    return true;
                });
        $this->assertTrue($v->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testCallbackNot()
    {
        $v = new Callback(function() {
                    return false;
                });
        $this->assertTrue($v->assert('w poiur'));
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