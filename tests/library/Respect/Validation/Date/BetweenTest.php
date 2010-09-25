<?php

namespace Respect\Validation\Date;

use DateTime;

class BetweenTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidDates
     */
    public function testBetweenValid($input, $min, $max)
    {
        $between = new Between($min, $max);
        $this->assertTrue($between->validate($input));
        $this->assertTrue($between->assert($input));
    }

    /**
     * @dataProvider providerForInvalidDates
     * @expectedException Respect\Validation\Date\OutOfBoundsException
     */
    public function testBetweenInvalid($input, $min, $max)
    {

        $between = new Between($min, $max);
        $this->assertFalse($between->validate($input));
        $this->assertFalse($between->assert($input));
    }

    /**
     * @dataProvider providerForInvalidConfigs
     * @expectedException Respect\Validation\ComponentException
     */
    public function testInvalidConfigs($min, $max)
    {

        $between = new Between($min, $max);
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
        );
    }

}