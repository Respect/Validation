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
        $this->assertEquals(1, count($v->getValidators()));
        $this->assertNull($v->getSubject());
        $this->assertNull($v->getRule());
        $this->assertEquals(array(), $v->getArguments());
    }

    public function testPartialInputChain()
    {
        $v = Validator::date()->between('yesterday', 'tomorrow')->string('notEmpty');
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertEquals(2, count($v->getValidators()));
        $this->assertNull($v->getSubject());
        $this->assertNull($v->getRule());
        $this->assertEquals(array(), $v->getArguments());
    }

    public function testValidateSimple()
    {
        $v = Validator::string('notEmpty')->validates('foo');
        $this->assertTrue($v);
    }

    public function testValidateArguments()
    {
        $v = Validator::date('between', 'yesterday', 'tomorrow')->validates('now');
        $this->assertTrue($v);
    }

    public function testValidateFluent()
    {
        $v = Validator::date()->between('yesterday', 'tomorrow')->validates('now');
        $this->assertTrue($v);
    }

    public function testValidateFluentChain()
    {
        $v = Validator::date()
                ->between('yesterday', 'tomorrow')
                ->string('notEmpty')
                ->validates('now');
        $this->assertTrue($v);
    }

}