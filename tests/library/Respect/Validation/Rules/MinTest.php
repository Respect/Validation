<?php

namespace Respect\Validation\Rules;

class MinTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidMin
     *
     */
    public function testMin($minValue, $input)
    {
        $min = new Min($minValue);
        $this->assertTrue($min->assert($input));
    }

    /**
     * @dataProvider providerForInvalidMin
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotMin($minValue, $input)
    {
        $min = new Min($minValue);
        $this->assertTrue($min->assert($input));
    }

    public function providerForValidMin()
    {
        return array(
            array(100, 165.0),
            array(-100, 200),
            array(200, 200),
            array(200, 300),
        );
    }

    public function providerForInvalidMin()
    {
        return array(
            array(500, 300),
            array(0, -250),
            array(0, -50),
        );
    }

}