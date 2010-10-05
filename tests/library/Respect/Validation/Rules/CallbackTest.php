<?php

namespace Respect\Validation\Rules;

class CallbackTest extends \PHPUnit_Framework_TestCase
{

    public function testCallbackOk()
    {
        $v = new Callback(function(){return true;});
        $this->assertTrue($v->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackNot()
    {
        $v = new Callback(function(){return false;});
        $this->assertTrue($v->assert('w poiur'));
    }

}