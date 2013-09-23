<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AssocException;
use Respect\Validation\Validator as v;

class AssocTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     */
    public function testShouldValidateAnArray()
    {
        $rules  = array('id' => new Int());
        $data   = array('id' => 123456);
        $rule   = new Assoc($rules);

        $this->assertTrue($rule->validate($data));
    }

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     */
    public function testShouldUseTheDefaultValidatorWhenNoValidatorIsDefined()
    {
        $rules  = array('id' => new Int());
        $data   = array('id' => 123456, 'active' => true, 'visible' => false);
        $rule   = new Assoc($rules, new Bool());

        $this->assertTrue($rule->validate($data));
    }

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     */
    public function testShouldUseAlwaysValidAsDefaultValidator()
    {
        $rules  = array();
        $data   = array('id' => 123456, 'active' => true, 'visible' => false);
        $rule   = new Assoc($rules);

        $this->assertTrue($rule->validate($data));
    }

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     */
    public function testShouldReturnFalseWhenValueIsNotAnArray()
    {
        $rules  = array();
        $data   = 1234567890;
        $rule   = new Assoc($rules);

        $this->assertFalse($rule->validate($data));
    }

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     * @expectedException Respect\Validation\Exceptions\StringException
     * @expectedExceptionMessage id must be a string
     */
    public function testShouldCheckValues()
    {
        $rules  = array('id' => new String());
        $data   = array('id' => 123456, 'code' => 123345);
        $rule   = new Assoc($rules);

        $rule->check($data);
    }

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     * @expectedException Respect\Validation\Exceptions\AssocException
     * @expectedExceptionMessage These rules must pass for the given data
     */
    public function testShouldAssertValues()
    {
        $rules   = array('id' => v::int()->equals(123), 'code' => v::string());
        $data   = array('id' => 123456, 'code' => 123345);
        $rule   = new Assoc($rules);

        $rule->assert($data);
    }

    /**
     * @covers Respect\Validation\Rules\Assoc::validate
     */
    public function testShouldAssertAllValues()
    {
        $rules   = array('id' => v::int()->equals(123), 'code' => v::string());
        $data   = array('id' => 123456, 'code' => 123345);
        $rule   = new Assoc($rules);
        $message  = <<<MESSAGE
\-These rules must pass for the given data
  |-These rules must pass for id
  | \-"123456" must be identical as 123
  \-These rules must pass for code
    \-"123345" must be a string
MESSAGE;

        try {
            $rule->assert($data);
        } catch (AssocException $exception) {
            $this->assertEquals($message, $exception->getFullMessage());
        }
    }

}
