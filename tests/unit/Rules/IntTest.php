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

class IntTest extends \PHPUnit_Framework_TestCase
{
    protected $intValidator;

    protected function setUp()
    {
        $this->intValidator = new Int();
    }

    /**
     * @dataProvider providerForInt
     */
    public function testValidIntegersShouldReturnTrue($input)
    {
        $this->assertTrue($this->intValidator->__invoke($input));
        $this->assertTrue($this->intValidator->check($input));
        $this->assertTrue($this->intValidator->assert($input));
    }

    /**
     * @dataProvider providerForNotInt
     * @expectedException Respect\Validation\Exceptions\IntException
     */
    public function testInvalidIntegersShouldThrowIntException($input)
    {
        $this->assertFalse($this->intValidator->__invoke($input));
        $this->assertFalse($this->intValidator->assert($input));
    }

    public function providerForInt()
    {
        return array(
            array(''),
            array(16),
            array('165'),
            array(123456),
            array(PHP_INT_MAX),
        );
    }

    public function providerForNotInt()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array('1.44'),
            array(1e-5),
        );
    }
}
