<?php

namespace Respect\Validation;

class ValidatorTest extends ValidatorTestCase
{

    public function testPartialInputSubject()
    {
        $v = Validator::dateBetween('yesterday', 'tomorrow');
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertEquals(1, count($v->getRules()));
        $this->assertNull($v->getRuleName());
        $this->assertEquals(array(), $v->getArguments());
    }

    public function testPartialInputChain()
    {
        $v = Validator::dateBetween('yesterday', 'tomorrow')->stringNotEmpty();
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertEquals(2, count($v->getRules()));
        $this->assertNull($v->getRuleName());
        $this->assertEquals(array(), $v->getArguments());
    }

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

}