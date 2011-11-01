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


    /**
     * @dataProvider providerForSanitizeInt
     */
    public function test_integer_filter_should_return_filtered_value($unfiltered, $expected, $filtered)
    {
        $this->assertSame($expected, $this->intValidator->sanitize($unfiltered));
        $this->assertSame($filtered, $this->intValidator->filter($unfiltered));
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

    public function providerForSanitizeInt()
    {
        return array(
            array(12, 12, 12),
            array('12 rabbits', 12, 12),
            array('1.44', 144, 144),
            array(1e-5, 10, 10),
            array('ksdhbf', 0, null),
            array('0', 0, 0),
            array('bucks 5', 5, 5),
        );
    }

}
