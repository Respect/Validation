<?php
namespace Respect\Validation\Rules;

use DateTime;

class MinimumAgeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidDateValidMinimumAge
     */
    public function testValidMinimumAgeInsideBoundsShouldPass($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertTrue($minimumAge->__invoke($input));
        $this->assertTrue($minimumAge->assert($input));
        $this->assertTrue($minimumAge->check($input));
    }

    /**
     * @dataProvider providerForValidDateInvalidMinimumAge
     * @expectedException Respect\Validation\Exceptions\MinimumAgeException
     */
    public function testInvalidMinimumAgeShouldThrowException($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertFalse($minimumAge->__invoke($input));
        $this->assertFalse($minimumAge->assert($input));
    }

    /**
     * @dataProvider providerForInvalidDate
     * @expectedException Respect\Validation\Exceptions\MinimumAgeException
     */
    public function testInvalidDateShouldNotPass($age, $format, $input)
    {
        $minimumAge = new MinimumAge($age, $format);
        $this->assertFalse($minimumAge->__invoke($input));
        $this->assertFalse($minimumAge->assert($input));
    }

    public function providerForValidDateValidMinimumAge()
    {
        return array(
            array(18, 'Y-m-d', ''),
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

