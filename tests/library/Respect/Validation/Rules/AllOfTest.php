<?php

namespace Respect\Validation\Rules;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\Exceptions\InvalidException;
use Respect\Validation\Validator;

class AllOfTest extends \PHPUnit_Framework_TestCase
{

    public function testValid()
    {
        $valid1 = new Callback(function() {
                    return true;
                });
        $valid2 = new Callback(function() {
                    return true;
                });
        $valid3 = new Callback(function() {
                    return true;
                });
        $o = new AllOf($valid1, $valid2, $valid3);
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
                    return true;
                });
        $valid3 = new Callback(function() {
                    return true;
                });
        $o = new AllOf($valid1, $valid2, $valid3);
        $this->assertFalse($o->assert('any'));
    }

}