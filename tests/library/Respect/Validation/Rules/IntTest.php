<?php

namespace Respect\Validation\Rules;

class IntTest extends \PHPUnit_Framework_TestCase
{

    protected $intValidator;

    protected function setUp()
    {
        $this->intValidator = new Int;
    }

    /**
     * @dataProvider providerForInt
     *
     */
    public function test_valid_integers_should_return_true($input)
    {
        $this->assertTrue($this->intValidator->validate($input));
        $this->assertTrue($this->intValidator->check($input));
        $this->assertTrue($this->intValidator->assert($input));
    }

    /**
     * @dataProvider providerForNotInt
     * @expectedException Respect\Validation\Exceptions\IntException
     */
    public function test_invalid_integers_should_throw_IntException($input)
    {
        $this->assertFalse($this->intValidator->validate($input));
        $this->assertFalse($this->intValidator->assert($input));
    }


    public function providerForInt()
    {
        return array(
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
            array(''),
            array('1.44'),
            array(1e-5),
        );
    }

}