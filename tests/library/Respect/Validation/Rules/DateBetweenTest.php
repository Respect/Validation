<?php

namespace Respect\Validation\Rules;

use DateTime;

class DateBetweenTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidDates
     */
    public function testBetweenValid($input, $min, $max)
    {
        $between = new DateBetween($min, $max);
        $this->assertTrue($between->validate($input));
        $this->assertTrue($between->assert($input));
    }

    /**
     * @dataProvider providerForInvalidDates
     * @expectedException Respect\Validation\Exceptions\DateOutOfBoundsException
     */
    public function testBetweenInvalid($input, $min, $max)
    {

        $between = new DateBetween($min, $max);
        $this->assertFalse($between->validate($input));
        $this->assertFalse($between->assert($input));
    }

    /**
     * @dataProvider providerForInvalidConfigs
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConfigs($min, $max)
    {

        $between = new DateBetween($min, $max);
    }

    public function providerForValidDates()
    {
        return array(
            array('now', 'yesterday', 'tomorrow'),
            array('now', 'now', 'tomorrow'),
            array('now', 'yesterday', 'now'),
            array('now', 'now', 'now'),
            array(new DateTime(), 'yesterday', 'tomorrow'),
        );
    }

    public function providerForInvalidDates()
    {
        return array(
            array('now', 'next month', 'next year'),
        );
    }

    public function providerForInvalidConfigs()
    {

        return array(
            array('tomorrow', 'yesterday'),
            array(new \stdClass, 'now'),
            array(array(), 'now'),
            array('now', array()),
            array(array(), new \stdClass),
        );
    }

}