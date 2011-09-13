<?php

namespace Respect\Validation\Rules;

class BoolTest extends \PHPUnit_Framework_TestCase
{

    public function testBool()
    {
        $validator = new Bool();
        $this->assertTrue($validator->validate(true));
        $this->assertTrue($validator->validate(false));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\BoolException
     */
    public function testNotBool()
    {
        $validator = new Bool();
        $validator->check('foo');
    }

}
