<?php
namespace Respect\Validation\Rules;

class MultipleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForMultiple
     *
     */
    public function testValidNumberMultipleOf($multipleOf, $input)
    {
        $multiple = new Multiple($multipleOf);
        $this->assertTrue($multiple->validate($input));
        $this->assertTrue($multiple->assert($input));
        $this->assertTrue($multiple->check($input));
    }

    /**
     * @dataProvider providerForNotMultiple
     * @expectedException Respect\Validation\Exceptions\MultipleException
     */
    public function testNotMultipleShouldThrowMultipleException($multipleOf, $input)
    {
        $multiple = new Multiple($multipleOf);
        $this->assertFalse($multiple->validate($input));
        $this->assertFalse($multiple->assert($input));
    }

    public function providerForMultiple()
    {
        return array(
            array('', ''),
            array(5, 20),
            array(5, 5),
            array(5, 0),
            array(5, -500),
            array(1, 0),
            array(1, 1),
            array(1, 2),
            array(1, 3),
            array(0, 0), // Only 0 is multiple of 0
        );
    }

    public function providerForNotMultiple()
    {
        return array(
            array(5, 11),
            array(5, 3),
            array(5, -1),
            array(3, 4),
            array(10, -8),
            array(10, 57),
            array(10, 21),
            array(0, 1),
            array(0, 2),
        );
    }
}

