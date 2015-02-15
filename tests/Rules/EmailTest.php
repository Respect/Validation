<?php
namespace Respect\Validation\Rules;

function class_exists($className)
{
    if (isset($GLOBALS['class_exists'][$className])) {
        return $GLOBALS['class_exists'][$className];
    }

    return \class_exists($className);
}

class EmailTest extends \PHPUnit_Framework_TestCase
{
    private function setEmailValidatorExists($value)
    {
        $GLOBALS['class_exists']['Egulias\EmailValidator\EmailValidator'] = (bool) $value;
    }

    private function resetClassExists()
    {
        unset($GLOBALS['class_exists']);
    }

    private function getEmailValidatorMock()
    {
        $emailValidatorMock = $this
            ->getMockBuilder('Egulias\\EmailValidator\\EmailValidator')
            ->disableOriginalConstructor()
            ->getMock();

        return $emailValidatorMock;
    }

    protected function setUp()
    {
        $this->setEmailValidatorExists(false);
    }

    protected function tearDown()
    {
        $this->resetClassExists();
    }

    public function testShouldAcceptInstanceOfEmailValidatorOnConstructor()
    {
        $this->resetClassExists();

        $emailValidator = $this->getEmailValidatorMock();

        $rule = new Email($emailValidator);

        $this->assertSame($emailValidator, $rule->getEmailValidator());
    }

    public function testShouldHaveADefaultInstanceOfEmailValidator()
    {
        $this->resetClassExists();

        $rule = new Email();

        $this->assertInstanceOf('Egulias\\EmailValidator\\EmailValidator', $rule->getEmailValidator());
    }

    public function testShouldUseEmailValidatorWhenDefined()
    {
        $this->resetClassExists();

        $input = 'example@example.com';

        $emailValidator = $this->getEmailValidatorMock();
        $emailValidator
            ->expects($this->once())
            ->method('isValid')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Email($emailValidator);

        $this->assertTrue($rule->validate($input));
    }

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

