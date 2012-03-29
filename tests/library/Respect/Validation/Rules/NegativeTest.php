<?php

namespace Respect\Validation\Rules;

class NegativeTest extends \PHPUnit_Framework_TestCase
{

    protected $negativeValidator;

    protected function setUp()
    {
        $this->negativeValidator = new Negative;
    }

    /**
     * @dataProvider providerForNegative
     *
     */
    public function test_negative_should_pass($input)
    {
        $this->assertTrue($this->negativeValidator->assert($input));
        $this->assertTrue($this->negativeValidator->validate($input));
        $this->assertTrue($this->negativeValidator->check($input));
    }

    /**
     * @dataProvider providerForNotNegative
     * @expectedException Respect\Validation\Exceptions\NegativeException
     */
    public function test_NOT_negative_numbers_should_throw_NegativeException($input)
    {
        $this->assertFalse($this->negativeValidator->validate($input));
        $this->assertFalse($this->negativeValidator->assert($input));
    }

    public function providerForNegative()
    {
        return array(
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
            array(''),
            array(16),
            array('165'),
            array(123456),
            array(1e10),
        );
    }

}