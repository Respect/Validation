<?php

namespace Respect\Validation\Rules;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\Exceptions\InvalidException;
use Respect\Validation\Validator;

class AllOfTest extends \PHPUnit_Framework_TestCase
{

    public function testRemoveRules()
    {
        $o = new AllOf(new Int, new Positive);
        $o->removeRules();
        $this->assertEquals(0, count($o->getRules()));
    }

    public function testAddRulesArrayMulti()
    {
        $o = new AllOf();
        $o->addRules(
            array(
                array($x = new Int, new Positive)
            )
        );
        $this->assertTrue($o->hasRule($x));
        $this->assertTrue($o->hasRule('Positive'));
    }

    public function testAddRulesSpec()
    {
        $o = new AllOf();
        $o->addRules(array("Between" => array(1, 2)));
        $this->assertTrue($o->hasRule('Between'));
    }

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
    public function testFilter()
    {
        $valid = new Digits();
        $filter = new Int();
        $o = new AllOf($valid, $filter);
        $this->assertTrue($o->validate(12));
        $this->assertSame(12, $o->filter('12 monkeys'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\AllOfException
     */
    public function testInvalid()
    {
        $theInvalidOne = new Callback(function() {
                    return false;
                });
        $valid2 = new Callback(function() {
                    return true;
                });
        $valid3 = new Callback(function() {
                    return true;
                });
        $o = new AllOf($theInvalidOne, $valid2, $valid3);
        $this->assertFalse($o->assert('any'));
        $o = new AllOf($valid2, $theInvalidOne, $valid3);
        $this->assertFalse($o->assert('any'));
        $o = new AllOf($valid2, $valid3, $theInvalidOne);
        $this->assertFalse($o->assert('any'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testCheck()
    {
        $valid1 = new Callback(function() {
                    return true;
                });
        $theInvalidOne = new Callback(function() {
                    return false;
                });
        $valid3 = new Callback(function() {
                    return true;
                });
        $o = new AllOf($valid1, $theInvalidOne, $valid3);
        $this->assertFalse($o->check('any'));
        $o = new AllOf($theInvalidOne, $valid3, $valid1);
        $this->assertFalse($o->check('any'));
        $o = new AllOf($valid3, $valid1, $theInvalidOne);
        $this->assertFalse($o->check('any'));
    }

}