<?php

namespace Respect\Validation;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testValidateSimple()
    {
        $v = Validator::notEmpty()->validate('foo');
        $this->assertTrue($v);
    }

    public function testValidateArguments()
    {
        $v = Validator::between(10, 20)->validate(15);
        $this->assertTrue($v);
    }

    public function testValidateFluent()
    {
        $v = Validator::between(10, 20)->validate(15);
        $this->assertTrue($v);
    }

    public function testValidateFluentChain()
    {
        $v = Validator::between(10, 20)->notEmpty()
            ->assert(15);
        $this->assertTrue($v);
    }

    public function testValidatorComposite()
    {
        $v = Validator::oneOf(
                Validator::notEmpty(), Validator::between(10, 20)
            )->validate(15);
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

    public function testSample()
    {

        $target = new \stdClass;
        $target->id = 13;
        $target->created_at = '2009-10-10';
        $target->name = 'Alexandre';

        $validator = Validator::object()
            ->oneOf(
                Validator::hasAttribute('screen_name',
                    Validator::alnum('_')->noWhitespace()),
                Validator::hasAttribute('id', Validator::numeric())
            )
            ->hasAttribute('created_at', Validator::date())
            ->hasAttribute('name', $v160 = Validator::stringLength(1, 160))
            ->hasOptionalAttribute('description', $v160)
            ->hasOptionalAttribute('location', $v160);
        try {
            $validator->assert($target);
        } catch (InvalidException $e) {
            echo $e->message();
        }
    }

}