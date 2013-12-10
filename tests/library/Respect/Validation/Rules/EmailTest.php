<?php
namespace Respect\Validation\Rules;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidEmail
     */
    public function testValidEmailShouldPass($validEmail)
    {
        $validator = new Email();
        $this->assertTrue($validator->__invoke($validEmail));
        $this->assertTrue($validator->check($validEmail));
        $this->assertTrue($validator->assert($validEmail));
    }

    /**
     * @dataProvider providerForInvalidEmail
     * @expectedException Respect\Validation\Exceptions\EmailException
     */
    public function testInvalidEmailsShouldFailValidation($invalidEmail)
    {
        $validator = new Email();
        $this->assertFalse($validator->__invoke($invalidEmail));
        $this->assertFalse($validator->assert($invalidEmail));
    }

    public function providerForValidEmail()
    {
        return array(
            array(''),
            array('test@test.com'),
            array('mail+mail@gmail.com'),
            array('mail.email@e.test.com'),
            array('a@a.a')
        );
    }

    public function providerForInvalidEmail()
    {
        return array(
            array('test@test'),
            array('test'),
            array('test@тест.рф'),
            array('@test.com'),
            array('mail@test@test.com'),
            array('test.test@'),
            array('test.@test.com'),
            array('test@.test.com'),
            array('test@test..com'),
            array('test@test.com.'),
            array('.test@test.com')
        );
    }
}

