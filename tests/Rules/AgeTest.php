<?php
namespace Respect\Validation\Rules;

use DateTime;

class AgeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidDateValidAge
     */
    public function testValidAgeInsideBoundsShouldPass($age, $format, $input)
    {
       $maximumAge = null;
        $minimumAge = new Age($age, $maximumAge, $format);
        $this->assertTrue($minimumAge->__invoke($input));
        $this->assertTrue($minimumAge->assert($input));
        $this->assertTrue($minimumAge->check($input));
    }

    /**
     * @dataProvider providerForValidDateInvalidAge
     * @expectedException Respect\Validation\Exceptions\AgeException
     */
    public function testInvalidAgeShouldThrowException($age, $format, $input)
    {
        $minimumAge = new Age($age, $format);
        $this->assertFalse($minimumAge->__invoke($input));
        $this->assertFalse($minimumAge->assert($input));
    }

    /**
     * @dataProvider providerForInvalidDate
     * @expectedException Respect\Validation\Exceptions\AgeException
     */
    public function testInvalidDateShouldNotPass($age, $format, $input)
    {
        $minimumAge = new Age($age, $format);
        $this->assertFalse($minimumAge->__invoke($input));
        $this->assertFalse($minimumAge->assert($input));
    }

    public function providerForValidDateValidAge()
    {
        return array(
            array(18, 'Y-m-d', ''),
            array(18, 'Y-m-d', '1969-07-20'),
            array(18, null, new \DateTime('1969-07-20')),
            array(18, 'Y-m-d', new \DateTime('1969-07-20')),
        );
    }

    public function providerForValidDateInvalidAge()
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
