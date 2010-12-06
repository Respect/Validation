<?php

namespace Respect\Validation\Rules;

class CallTest extends \PHPUnit_Framework_TestCase
{

    public function testCallbackOk()
    {
        $v = new Call('str_split', new Arr);
        $this->assertTrue($v->assert('test'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testCallbackNot()
    {
        $v = new Call('strrev', new Arr);
        $this->assertTrue($v->assert('test'));
    }

}