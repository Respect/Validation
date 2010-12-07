<?php

namespace Respect\Validation\Rules;

class CallTest extends \PHPUnit_Framework_TestCase
{

    public function callbackThis()
    {
        return array();
    }

    public function testCallbackOk()
    {
        $v = new Call('str_split', new Arr);
        $this->assertTrue($v->assert('test'));
    }

    public function testCallbackObject()
    {
        $v = new Call(array($this, 'callbackThis'), new Arr);
        $this->assertTrue($v->assert('test'));
    }

    public function testCallbackClosure()
    {
        $v = new Call(function() {
                    return array();
                }, new Arr);
        $this->assertTrue($v->assert('test'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallException
     */
    public function testCallbackNot()
    {
        $v = new Call('strrev', new Arr);
        $this->assertTrue($v->assert('test'));
    }

}