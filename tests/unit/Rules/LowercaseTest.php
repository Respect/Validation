<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Lowercase
 * @covers Respect\Validation\Exceptions\LowercaseException
 */
class LowercaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidLowercase
     */
    public function testValidLowercaseShouldReturnTrue($input)
    {
        $lowercase = new Lowercase();
        $this->assertTrue($lowercase->validate($input));
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
        $this->assertFalse($lowercase->validate($input));
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
