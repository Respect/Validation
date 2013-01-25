<?php
namespace Respect\Validation\Rules;

class LowercaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidLowercase
     */
    public function testValidLowercaseShouldReturnTrue($input)
    {
        $lowercase = new Lowercase();
        $this->assertTrue($lowercase->__invoke($input));
        $this->assertTrue($lowercase->assert($input));
        $this->assertTrue($lowercase->check($input));
    }

    /**
     * @dataProvider providerForInvalidLowercase
     * @expectedException Respect\Validation\Exceptions\LowercaseException
     */
    public function testInvalidLowercaseShouldThrowException($input)
    {
        $lowercase = new Lowercase();
        $this->assertFalse($lowercase->__invoke($input));
        $this->assertFalse($lowercase->assert($input));
    }

    public function providerForValidLowercase()
    {
        return array(
            array(''),
            array('lowercase'),
            array('lowercase-with-dashes'),
            array('lowercase with spaces'),
            array('lowercase with numbers 123'),
            array('lowercase with specials characters like ã ç ê'),
            array('with specials characters like # $ % & * +'),
            array('τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός'),
        );
    }

    public function providerForInvalidLowercase()
    {
        return array(
            array('UPPERCASE'),
            array('CamelCase'),
            array('First Character Uppercase'),
            array('With Numbers 1 2 3'),
        );
    }
}

