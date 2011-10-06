<?php

namespace Respect\Validation\Rules;

use DateTime;

class MinimumAgeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidDateValidMinimumAge
     */
    public function test_valid_minimum_age_inside_bounds_should_pass($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertTrue($minimumAge->validate($input));
        $this->assertTrue($minimumAge->assert($input));
        $this->assertTrue($minimumAge->check($input));
    }
    
    /**
     * @dataProvider providerForValidDateInvalidMinimumAge
     * @expectedException Respect\Validation\Exceptions\MinimumAgeException
     */
    public function test_invalid_minimum_age_should_throw_exception($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertFalse($minimumAge->validate($input));
        $this->assertFalse($minimumAge->assert($input));
    }
    
    /**
     * @dataProvider providerForInvalidDate
     * @expectedException Respect\Validation\Exceptions\MinimumAgeException
     */
    public function test_invalid_date_should_not_pass($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertFalse($minimumAge->validate($input));
        $this->assertFalse($minimumAge->assert($input));
    }
    
    public function providerForValidDateValidMinimumAge()
    {
        return array(
            array(18, 'Y-m-d', '1969-07-20'),
            array(18, null, new \DateTime('1969-07-20')),
            array(18, 'Y-m-d', new \DateTime('1969-07-20')),
        );
    }
    
    public function providerForValidDateInvalidMinimumAge()
    {
        return array(
            array(18, 'Y-m-d', '2002-06-30'),
            array(18, null, new \DateTime('2002-06-30')),
            array(18, 'Y-m-d', new \DateTime('2002-06-30')),
        );
    }
    
    public function providerForInvalidDate()
    {
        return array(
            array(18, null, 'invalid-input'),
            array(18, null, new \stdClass),
            array(18, 'y-m-d', '2002-06-30'),
        );
    }

}