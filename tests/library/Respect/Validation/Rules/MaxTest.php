<?php

namespace Respect\Validation\Rules;

class MaxTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidMax
     *
     */
    public function testMax($maxValue, $input)
    {
        $max = new Max($maxValue);
        $this->assertTrue($max->assert($input));
    }

    /**
     * @dataProvider providerForInvalidMax
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotMax($maxValue, $input)
    {
        $max = new Max($maxValue);
        $this->assertTrue($max->assert($input));
    }

    public function providerForValidMax()
    {
        return array(
            array(200, 165.0),
            array(200, -200),
            array(200, 200),
            array(200, 0),
        );
    }

    public function providerForInvalidMax()
    {
        return array(
            array(200, 300),
            array(200, 250),
            array(200, 1500),
        );
    }

}