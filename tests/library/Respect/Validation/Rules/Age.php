<?php
namespace Respect\Validation\Rules;

use DateTime;

class AgeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidDateValidAge
     */
    public function testValidMinimumAgeInsideBoundsShouldPass($minAge, $maxAge, $input)
    {
        $minimumAge = new Age($minAge, $maxAge);
        $this->assertTrue($minimumAge->__invoke($input));
        $this->assertTrue($minimumAge->assert($input));
        $this->assertTrue($minimumAge->check($input));
    }

    /**
     * @dataProvider providerForValidDateInvalidAge
     * @expectedException Respect\Validation\Exceptions\AgeException
     */
    public function testInvalidMinimumAgeShouldThrowException($minAge, $maxAge, $input)
    {
        $minimumAge = new Age($minAge, $maxAge);
        $this->assertFalse($minimumAge->__invoke($input));
        $this->assertFalse($minimumAge->assert($input));
    }

    /**
     * @dataProvider providerForInvalidDate
     * @expectedException Respect\Validation\Exceptions\AgeException
     */
    public function testInvalidDateShouldNotPass($minAge, $maxAge, $input)
    {
        $minimumAge = new Age($minAge, $maxAge);
        $this->assertFalse($minimumAge->__invoke($input));
        $this->assertFalse($minimumAge->assert($input));
    }

    public function providerForValidDateValidAge()
    {
        return array(
            array(18, 25, ''),
            array(18, 25, '1969-07-20'),
            array(18, null, new \DateTime('1969-07-20')),
            array(18, 25, new \DateTime('1969-07-20')),
        );
    }

    public function providerForValidDateInvalidAge()
    {
        return array(
            array(18, 25, '2002-06-30'),
            array(18, null, new \DateTime('2002-06-30')),
            array(18, 35, new \DateTime('2002-06-30')),
        );
    }

    public function providerForInvalidDate()
    {
        return array(
            array(18, null, 'invalid-input'),
            array(18, 25, new \stdClass),
            array(18, 25, '2002-06-30'),
        );
    }
}

