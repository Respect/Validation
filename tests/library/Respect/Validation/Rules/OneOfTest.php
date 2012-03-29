<?php

namespace Respect\Validation\Rules;


class OneOfTest extends \PHPUnit_Framework_TestCase
{

    public function testValid()
    {
        $valid1 = new Callback(function() {
                    return false;
                });
        $valid2 = new Callback(function() {
                    return true;
                });
        $valid3 = new Callback(function() {
                    return false;
                });
        $o = new OneOf($valid1, $valid2, $valid3);
        $this->assertTrue($o->validate('any'));
        $this->assertTrue($o->assert('any'));
        $this->assertTrue($o->check('any'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalid()
    {
        $valid1 = new Callback(function() {
                    return false;
                });
        $valid2 = new Callback(function() {
                    return false;
                });
        $valid3 = new Callback(function() {
                    return false;
                });
        $o = new OneOf($valid1, $valid2, $valid3);
        $this->assertFalse($o->validate('any'));
        $this->assertFalse($o->assert('any'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\HexaException
     */
    public function testInvalidCheck()
    {
        $o = new OneOf(new Hexa, new Alnum);
        $this->assertFalse($o->validate(-10));
        $this->assertFalse($o->check(-10));
    }

}