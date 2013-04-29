<?php
namespace Respect\Validation\Rules;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    protected $phoneValidator;

    protected function setUp()
    {
        $this->phoneValidator = new Phone;
    }

    /**
     * @dataProvider providerForPhone
     *
     */
    public function testValidPhoneShouldReturnTrue($input)
    {
        $this->assertTrue($this->phoneValidator->__invoke($input));
        $this->assertTrue($this->phoneValidator->assert($input));
        $this->assertTrue($this->phoneValidator->check($input));
    }

    /**
     * @dataProvider providerForNotPhone
     * @expectedException Respect\Validation\Exceptions\PhoneException
     */
    public function testInvalidPhoneShouldThrowPhoneException($input)
    {
        $this->assertFalse($this->phoneValidator->__invoke($input));
        $this->assertFalse($this->phoneValidator->assert($input));
    }

    public function providerForPhone()
    {
        return array(
            array(''),
            array('+5-555-555-5555'),
            array('+5 555 555 5555'),
            array('+5.555.555.5555'),
            array('5-555-555-5555'),
            array('5.555.555.5555'),
            array('5 555 555 5555'),
            array('555.555.5555'),
            array('555 555 5555'),
            array('555-555-5555'),
            array('555-5555555'),
            array('5(555)555.5555'),
            array('+5(555)555.5555'),
            array('+5(555)555 5555'),
            array('+5(555)555-5555'),
            array('+5(555)5555555'),
            array('(555)5555555'),
            array('(555)555.5555'),
            array('(555)555-5555'),
            array('(555) 555 5555'),
            array('55555555555'),
            array('5555555555'),
            array('+33(1)2222222'),
            array('+33(1)222 2222'),
            array('+33(1)222.2222'),
            array('+33(1)22 22 22 22'),
            array('33(1)2222222'),
            array('33(1)22222222'),
            array('33(1)22 22 22 22'),
            array('(020) 7476 4026'),
            array('33(020) 7777 7777'),
            array('33(020)7777 7777'),
            array('+33(020) 7777 7777'),
            array('+33(020)7777 7777'),
            array('03-6106666'),
            array('036106666'),
            
        );
    }

    public function providerForNotPhone()
    {
        return array(
            array('123'),
            array('s555-5555'),
            array('555-5555'),
            array('5555555'),
            array('555.5555'),
            array('555-555'),
            array('555555'),
            array('555+5555'),
            array('(555)555555'),
            array('(555)55555'),
            array('+(555)555 555'),
            array('+5(555)555 555'),
            array('+5(555)555 555 555'),
            array('555)555 555'),
            array('+5(555)5555 555'),
            array('(555)55 555'),
            array('(555)5555 555'),
            array('+5(555)555555'),
            array('5(555)55 55555'),
            array('(5)555555'),
            array('+55(5)55 5 55 55'),
            array('+55(5)55 55 55 5'),
            array('+55(5)55 55 55'),
            array('+55(5)5555 555'),
            array('+55()555 5555'),
            array('03610666-5'),
            array('text'),
        );
    }
}

