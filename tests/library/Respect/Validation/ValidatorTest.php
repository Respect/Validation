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
     * @expectedException Respect\Validation\Exceptions\ValidationException
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
        $target->sex = 'foo';
        $target->id = 49549;

        $validator = Validator::object()
            ->oneOf(
                Validator::hasAttribute('screen_name',
                    Validator::alnum('_')->noWhitespace()),
                Validator::hasAttribute('id',
                    Validator::numeric()
                    ->between(1, 15))
            )
            ->hasAttribute('created_at', Validator::date())
            ->hasAttribute('name', $v160 = Validator::stringLength(1, 160))
            ->hasAttribute('sex',
                Validator::allOf(
                    Validator::hexa(), Validator::float(), Validator::numeric()
                ))
            ->hasOptionalAttribute('description', $v160)
            ->hasOptionalAttribute('location', $v160);
        try {
            $validator->assert($target);
        } catch (InvalidException $e) {
            echo $e->message();
        }
    }

}