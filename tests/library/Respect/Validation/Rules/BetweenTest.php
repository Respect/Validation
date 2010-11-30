<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator;
use \DateTime;

class BetweenTest extends \PHPUnit_Framework_TestCase
{

    public function providerValid()
    {
        $n = Validator::numeric();
        $d = Validator::date();
        return array(
            array(0, 1, 0, $n),
            array(0, 1, 1, $n),
            array(10, 20, 15, $n),
            array(10, 20, 20, $n),
            array(-10, 20, -5, $n),
            array(-10, 20, 0, $n),
            array(
                new DateTime('yesterday'),
                new DateTime('tomorrow'),
                new DateTime('now'),
                $d
            ),
        );
    }

    public function providerInvalid()
    {
        $n = Validator::numeric();
        return array(
            array(0, 1, 2, $n),
            array(0, 1, -1, $n),
            array(10, 20, 999, $n),
            array(-10, 20, -11, $n),
        );
    }

    public function providerInvalidComponentParameters()
    {
        $n = Validator::numeric();
        return array(
            array('a', 1, 1, $n),
            array(0, ' ', 1, $n),
        );
    }

    public function providerInvalidInput()
    {
        $n = Validator::numeric();
        return array(
            array(10, 20, 'zas a', $n),
            array(-10, 20, ' ', $n)
        );
    }

    /**
     * @dataProvider providerValid
     */
    public function testBetweenBounds($min, $max, $input, $type)
    {
        $o = new Between($min, $max, $type);
        $this->assertTrue($o->assert($input));
        $o = new Between($min, $max);
        $this->assertTrue($o->assert($input));
    }

    /**
     * @dataProvider providerInvalid
     * @expectedException Respect\Validation\Exceptions\BetweenException
     */
    public function testNotBetweenBounds($min, $max, $input, $type)
    {
        $o = new Between($min, $max, $type);
        $this->assertTrue($o->assert($input));
    }

    /**
     * @dataProvider providerInvalidComponentParameters
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testComponentParameters($min, $max, $input, $type)
    {
        $o = new Between($min, $max, $type);
        $this->assertTrue($o->assert($input));
    }

    /**
     * @dataProvider providerInvalidInput
     * @expectedException Respect\Validation\Exceptions\InvalidException
     */
    public function testInvalidInput($min, $max, $input, $type)
    {
        $o = new Between($min, $max, $type);
        $this->assertTrue($o->assert($input));
    }

}