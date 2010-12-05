<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator;
use \DateTime;

class BetweenTest extends \PHPUnit_Framework_TestCase
{

    public function providerValid()
    {
        return array(
            array(0, 1, 0),
            array(0, 1, 1),
            array(10, 20, 15),
            array(10, 20, 20),
            array(-10, 20, -5),
            array(-10, 20, 0),
            array(
                new DateTime('yesterday'),
                new DateTime('tomorrow'),
                new DateTime('now')
            ),
        );
    }

    public function providerInvalid()
    {
        return array(
            array(0, 1, 2),
            array(0, 1, -1),
            array(10, 20, 999),
            array(-10, 20, -11),
        );
    }

    /**
     * @dataProvider providerValid
     */
    public function testBetweenBounds($min, $max, $input)
    {
        $o = new Between($min, $max);
        $this->assertTrue($o->assert($input));
        $o = new Between($min, $max);
        $this->assertTrue($o->assert($input));
    }

    /**
     * @dataProvider providerInvalid
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotBetweenBounds($min, $max, $input)
    {
        $o = new Between($min, $max);
        $this->assertTrue($o->assert($input));
    }

}