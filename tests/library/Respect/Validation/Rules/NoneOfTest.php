<?php

namespace Respect\Validation\Rules;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\Exceptions\InvalidException;

class NoneOfTest extends \PHPUnit_Framework_TestCase
{

    public function testValid()
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
        $o = new NoneOf($valid1, $valid2, $valid3);
        $this->assertTrue($o->assert('any'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
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
                    return true;
                });
        $o = new NoneOf($valid1, $valid2, $valid3);
        $this->assertFalse($o->assert('any'));
    }

}