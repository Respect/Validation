<?php

namespace Respect\Validation;

class ValidatorTest extends ValidatorTestCase
{

    public function testSimpleValidateCall()
    {
        $valid = Validator::valid('now', 'Date\Between', 'yesterday', 'tomorrow');
        $this->assertTrue($valid);
    }

    public function testDynamicValidateCall()
    {
        $valid = Validator::validDate('now', 'Between', 'yesterday', 'tomorrow');
        $this->assertTrue($valid);
    }

    public function testSimpleIsValidCall()
    {
        $valid = Validator::is('now', 'Date\Between', 'yesterday', 'tomorrow');
        $this->assertTrue($valid);
    }

    public function testDynamicIsValidCall()
    {
        $valid = Validator::isDate('now', 'Between', 'yesterday', 'tomorrow');
        $this->assertTrue($valid);
    }

    public function testNodeName()
    {
        $valid = Validator::isDate('now', 'between', 'yesterday', 'tomorrow');
        $this->assertTrue($valid);
    }

    public function testNodeName2()
    {
        $valid = Validator::is('now', 'date\between', 'yesterday', 'tomorrow');
        $this->assertTrue($valid);
    }

}