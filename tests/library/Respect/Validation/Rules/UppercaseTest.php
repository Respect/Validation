<?php
namespace Respect\Validation\Rules;

class UppercaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidUppercase
     */
    public function testValidUppercaseShouldReturnTrue($input)
    {
        $uppercase = new Uppercase();
        $this->assertTrue($uppercase->validate($input));
        $this->assertTrue($uppercase->assert($input));
        $this->assertTrue($uppercase->check($input));
    }

    /**
     * @dataProvider providerForInvalidUppercase
     * @expectedException Respect\Validation\Exceptions\UppercaseException
     */
    public function testInvalidUppercaseShouldThrowException($input)
    {
        $lowercase = new Uppercase();
        $this->assertFalse($lowercase->validate($input));
        $this->assertFalse($lowercase->assert($input));
    }

    public function providerForValidUppercase()
    {
        return array(
            array(''),
            array('UPPERCASE'),
            array('UPPERCASE-WITH-DASHES'),
            array('UPPERCASE WITH SPACES'),
            array('UPPERCASE WITH NUMBERS 123'),
            array('UPPERCASE WITH SPECIALS CHARACTERS LIKE Ã Ç Ê'),
            array('WITH SPECIALS CHARACTERS LIKE # $ % & * +'),
            array('ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ'),
        );
    }

    public function providerForInvalidUppercase()
    {
        return array(
            array('lowercase'),
            array('CamelCase'),
            array('First Character Uppercase'),
            array('With Numbers 1 2 3'),
        );
    }
}

