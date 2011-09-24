<?php

namespace Respect\Validation\Rules;

use DateTime;

class MinimumAgeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidDateValidMinimumAge
     *
     */
    public function testForValidDateValidMinimumAge($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertTrue($minimumAge->assert($input));
    }
    
    /**
     * @dataProvider providerForValidDateInvalidMinimumAge
     * @expectedException Respect\Validation\Exceptions\MinimumAgeException
     */
    public function testForValidDateInvalidMinimumAge($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertTrue($minimumAge->assert($input));
    }
    
    /**
     * @dataProvider providerForInvalidDate
     * @expectedException Respect\Validation\Exceptions\MinimumAgeException
     */
    public function testInvalidDate($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertTrue($minimumAge->assert($input));
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