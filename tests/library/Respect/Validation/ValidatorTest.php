<?php

namespace Respect\Validation;

class ValidatorTest extends ValidatorTestCase
{

    public function testPartialEmpty()
    {
        $v = Validator::is();
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertSame('is', $v->getOperation());
    }

    public function testPartialInputOnly()
    {
        $v = Validator::is('something');
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertSame('is', $v->getOperation());
        $this->assertSame('something', $v->getInput());
    }

    public function testPartialInputSubject()
    {
        $v = Validator::is('now', 'date');
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertSame('is', $v->getOperation());
        $this->assertSame('now', $v->getInput());
        $this->assertSame('date', $v->getSubject());
    }

    public function testValidateSimple()
    {
        $v = Validator::is('foo', 'string', 'notEmpty');
        $this->assertTrue($v);
    }

    public function testValidateArguments()
    {
        $v = Validator::is('now', 'date', 'between', 'yesterday', 'tomorrow');
        $this->assertTrue($v);
    }

    public function testFluentSubjectGetter()
    {
        $v = Validator::is('now')->date;
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertSame('is', $v->getOperation());
        $this->assertSame('now', $v->getInput());
        $this->assertSame('date', $v->getSubject());
    }

    public function testFluentSubjectCall()
    {
        $v = Validator::is('now')->date();
        $this->assertType('Respect\Validation\Validator', $v);
        $this->assertSame('is', $v->getOperation());
        $this->assertSame('now', $v->getInput());
        $this->assertSame('date', $v->getSubject());
    }

    public function testFluentSubjectGetterMixed()
    {
        $v = Validator::is('now')->date->between('yesterday', 'tomorrow');
        $this->assertTrue($v);
    }

    public function testFluentSubjectCallMixed()
    {
        $v = Validator::is('now', 'date')->between('yesterday', 'tomorrow');
        $this->assertTrue($v);
    }

    public function testFluentSubjectCallMixed2()
    {
        $v = Validator::is('now')->date('between', 'yesterday', 'tomorrow');
        $this->assertTrue($v);
    }

}