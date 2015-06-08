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

class NegativeTest extends \PHPUnit_Framework_TestCase
{
    protected $negativeValidator;

    protected function setUp()
    {
        $this->negativeValidator = new Negative();
    }

    /**
     * @dataProvider providerForNegative
     */
    public function testNegativeShouldPass($input)
    {
        $this->assertTrue($this->negativeValidator->assert($input));
        $this->assertTrue($this->negativeValidator->__invoke($input));
        $this->assertTrue($this->negativeValidator->check($input));
    }

    /**
     * @dataProvider providerForNotNegative
     * @expectedException Respect\Validation\Exceptions\NegativeException
     */
    public function testNotNegativeNumbersShouldThrowNegativeException($input)
    {
        $this->assertFalse($this->negativeValidator->__invoke($input));
        $this->assertFalse($this->negativeValidator->assert($input));
    }

    public function providerForNegative()
    {
        return array(
            array(''),
            array('-1.44'),
            array(-1e-5),
            array(-10),
        );
    }

    public function providerForNotNegative()
    {
        return array(
            array(0),
            array(-0),
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(16),
            array('165'),
            array(123456),
            array(1e10),
        );
    }
}
