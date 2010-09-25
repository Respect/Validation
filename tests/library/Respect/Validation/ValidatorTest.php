<?php

namespace Respect\Validation;

class ValidatorTest extends ValidatorTestCase
{

    public function testPartialEmpty()
    {
        $v = Validator::date();
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertSame('date', $v->getSubject());
    }

    public function testPartialInputSubject()
    {
        $v = Validator::date('between', 'yesterday', 'tomorrow');
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertEquals(1, count($v->getRules()));
        $this->assertNull($v->getSubject());
        $this->assertNull($v->getRuleName());
        $this->assertEquals(array(), $v->getArguments());
    }

    public function testPartialInputChain()
    {
        $v = Validator::date()->between('yesterday', 'tomorrow')
                ->string('notEmpty');
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertEquals(2, count($v->getRules()));
        $this->assertNull($v->getSubject());
        $this->assertNull($v->getRuleName());
        $this->assertEquals(array(), $v->getArguments());
    }

    public function testValidateSimple()
    {
        $v = Validator::string('notEmpty')->validate('foo');
        $this->assertTrue($v);
    }

    public function testValidateArguments()
    {
        $v = Validator::date('between', 'yesterday', 'tomorrow')
                ->validate('now');
        $this->assertTrue($v);
    }

    public function testValidateFluent()
    {
        $v = Validator::date()->between('yesterday', 'tomorrow')
                ->validate('now');
        $this->assertTrue($v);
    }

    public function testValidateFluentChain()
    {
        $v = Validator::date()->between('yesterday', 'tomorrow')
                ->string('notEmpty')
                ->assert('now');
        $this->assertTrue($v);
    }

    public function testValidatorComposite()
    {
        $v = Validator::composite()->one(
                Validator::string()->notEmpty,
                Validator::date()->between('+2 years', '+3 years')
            )->validate('now');
        $this->assertTrue($v);
    }

}