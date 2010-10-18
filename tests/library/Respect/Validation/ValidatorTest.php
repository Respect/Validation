<?php

namespace Respect\Validation;

class ValidatorTest extends ValidatorTestCase
{

    public function testValidateSimple()
    {
        $v = Validator::stringNotEmpty()->validate('foo');
        $this->assertTrue($v);
    }

    public function testValidateArguments()
    {
        $v = Validator::dateBetween('yesterday', 'tomorrow')->validate('now');
        $this->assertTrue($v);
    }

    public function testValidateFluent()
    {
        $v = Validator::dateBetween('yesterday', 'tomorrow')->validate('now');
        $this->assertTrue($v);
    }

    public function testValidateFluentChain()
    {
        $v = Validator::dateBetween('yesterday', 'tomorrow')->stringNotEmpty()
                ->assert('now');
        $this->assertTrue($v);
    }

    public function testValidatorComposite()
    {
        $v = Validator::one(
                Validator::stringNotEmpty(),
                Validator::dateBetween('+2 years', '+3 years')
            )->validate('now');
        $this->assertTrue($v);
    }

    public function testValidatorCompositeTwitterUsername()
    {
        $v = Validator::alnum('_')
                ->noWhitespace()
                ->stringLength(1, 15)
                ->assert('alganet');
        $this->assertTrue($v);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InvalidException
     */
    public function testValidatorCompositeTwitterUsernameInvalid()
    {
        $v = Validator::alnum('_')
                ->noWhitespace()
                ->stringLength(1, 15)
                ->assert('#$%  #odjfubgihdbfgihbdfighb');
        $this->assertTrue($v);
    }

}