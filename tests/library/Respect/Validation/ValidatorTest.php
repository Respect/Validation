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
                Validator::attribute(
                    'screen_name', Validator::alnum('_')->noWhitespace()
                ),
                Validator::attribute(
                    'id', Validator::numeric()->between(1, 15)
                )
            )
            ->attribute('created_at', Validator::date())
            ->attribute('name', $v160 = Validator::stringLength(1, 160))
            ->attribute('sex',
                Validator::oneOf(
                    Validator::hexa(), Validator::float(), Validator::numeric()
                ))
            ->attribute('description', $v160, false)
            ->attribute('location', $v160, false);
        try {
            $validator->assert($target);
        } catch (Exceptions\ValidationException $e) {
            echo $e->getMessage();
        }
    }

}