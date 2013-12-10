<?php
namespace Respect\Validation;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testStaticCreateShouldReturnNewValidator()
    {
        $this->assertInstanceOf('Respect\Validation\Validator', Validator::create());
    }

    public function testInvalidRuleClassShouldThrowComponentException()
    {
        $this->setExpectedException('Respect\Validation\Exceptions\ComponentException');
        Validator::iDoNotExistSoIShouldThrowException();
    }
    public function testSetTemplateWithSingleValidatorShouldUseTemplateAsMainMessage()
    {
        try {
            Validator::callback('is_int')->setTemplate('{{name}} is not tasty')->assert('something');
        } catch (\Exception $e) {
            $this->assertEquals('"something" is not tasty', $e->getMainMessage());
        }
    }
    public function testSetTemplateWithMultipleValidatorsShouldUseTemplateAsMainMessage()
    {
        try {
            Validator::callback('is_int')->between(1,2)->setTemplate('{{name}} is not tasty')->assert('something');
        } catch (\Exception $e) {
            $this->assertEquals('"something" is not tasty', $e->getMainMessage());
        }
    }
    public function testSetTemplateWithMultipleValidatorsShouldUseTemplateAsFullMessage()
    {
        try {
            Validator::callback('is_string')->between(1,2)->setTemplate('{{name}} is not tasty')->assert('something');
        } catch (\Exception $e) {
            $this->assertEquals('\-"something" is not tasty
  \-"something" must be greater than 1', $e->getFullMessage());
        }
    }
    public function testGetFullMessageShouldIncludeAllValidationMessagesInAChain()
    {
        try {
            Validator::string()->length(1,15)->assert('');
        } catch (\Exception $e) {
            $this->assertEquals('\-These rules must pass for ""
  \-"" must have a length between 1 and 15', $e->getFullMessage());
        }
    }

    public function testNotShouldWorkByBuilder()
    {
        $this->assertFalse(Validator::not(Validator::int())->validate(10));
    }
    public function testCountryCode()
    {
        $this->assertTrue(Validator::countryCode()->validate('BR'));
    }
    public function testAlwaysValid()
    {
        $this->assertTrue(Validator::alwaysValid()->validate('sojdnfjsdnfojsdnfos dfsdofj sodjf '));
    }
    public function testAlwaysInvalid()
    {
        $this->assertFalse(Validator::alwaysInvalid()->validate('sojdnfjsdnfojsdnfos dfsdofj sodjf '));
    }

    public function testIssue85FindMessagesShouldNotTriggerCatchableFatalError()
    {
        $usernameValidator = Validator::alnum('_')->length(1,15)->noWhitespace();
        try {
            $usernameValidator->assert('really messed up screen#name');
        } catch (\InvalidArgumentException $e) {
            $e->findMessages(array('alnum', 'length', 'noWhitespace'));
        }
    }

    public function testKeysAsValidatorNames()
    {
        try {
            Validator::key('username', Validator::length(1,32))
                     ->key('birthdate', Validator::date())
                     ->setName("User Subscription Form")
                     ->assert(array('username' => '', 'birthdate' => ''));
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('\-These rules must pass for User Subscription Form
  |-Key username must be valid
  | \-"" must have a length between 1 and 32
  \-Key birthdate must be valid
    \-"" must be a valid date', $e->getFullMessage());
        }
    }
}

