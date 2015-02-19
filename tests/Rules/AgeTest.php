<?php
namespace Respect\Validation\Rules;

use DateTime;

/**
 * @covers Respect\Validation\Rules\Age
 * @covers Respect\Validation\Exceptions\AgeException
 */
class AgeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage An age interval must be provided
     */
    public function testShouldThrowsExceptionWhenThereIsNoArgumentsOnConstructor()
    {
        new Age();
    }
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage 20 cannot be greater than or equals to 10
     */
    public function testShouldThrowsExceptionWhenMinimumAgeIsLessThenMaximumAge()
    {
        new Age(20, 10);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage 20 cannot be greater than or equals to 20
     */
    public function testShouldThrowsExceptionWhenMinimumAgeIsEqualsToMaximumAge()
    {
        new Age(20, 20);
    }

    public function providerForValidAge()
    {
        return array(
            array(18, null, date('Y-m-d', strtotime('-18 years'))),
            array(18, null, date('Y-m-d', strtotime('-19 years'))),
            array(18, null, new DateTime('-18 years')),
            array(18, null, new DateTime('-19 years')),

            array(18, 50, date('Y-m-d', strtotime('-18 years'))),
            array(18, 50, date('Y-m-d', strtotime('-50 years'))),
            array(18, 50, new DateTime('-18 years')),
            array(18, 50, new DateTime('-50 years')),

            array(null, 50, date('Y-m-d', strtotime('-49 years'))),
            array(null, 50, date('Y-m-d', strtotime('-50 years'))),
            array(null, 50, new DateTime('-49 years')),
            array(null, 50, new DateTime('-50 years')),
        );
    }

    /**
     * @dataProvider providerForValidAge
     */
    public function testShouldValidateValidAge($minAge, $maxAge, $input)
    {
        $rule = new Age($minAge, $maxAge);

        $this->assertTrue($rule->validate($input));
    }

    public function providerForInvalidAge()
    {
        return array(
            array(18, null, date('Y-m-d', strtotime('-17 years'))),
            array(18, null, new DateTime('-17 years')),

            array(18, 50, date('Y-m-d', strtotime('-17 years'))),
            array(18, 50, date('Y-m-d', strtotime('-51 years'))),
            array(18, 50, new DateTime('-17 years')),
            array(18, 50, new DateTime('-51 years')),

            array(null, 50, date('Y-m-d', strtotime('-51 years'))),
            array(null, 50, new DateTime('-51 years')),
        );
    }

    /**
     * @dataProvider providerForInvalidAge
     */
    public function testShouldValidateInvalidAge($minAge, $maxAge, $input)
    {
        $rule = new Age($minAge, $maxAge);

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @depends testShouldValidateInvalidAge
     *
     * @expectedException Respect\Validation\Exceptions\AgeException
     * @expectedExceptionMessage "today" must be lower than 18 years ago
     */
    public function testShouldThrowsExceptionWhenMinimumAgeFails()
    {
        $rule = new Age(18);
        $rule->assert('today');
    }

    /**
     * @depends testShouldValidateInvalidAge
     *
     * @expectedException Respect\Validation\Exceptions\AgeException
     * @expectedExceptionMessage "51 years ago" must be greater than 50 years ago
     */
    public function testShouldThrowsExceptionWhenMaximunAgeFails()
    {
        $rule = new Age(null, 50);
        $rule->assert('51 years ago');
    }

    /**
     * @depends testShouldValidateInvalidAge
     *
     * @expectedException Respect\Validation\Exceptions\AgeException
     * @expectedExceptionMessage "today" must be between 18 and 50 years ago
     */
    public function testShouldThrowsExceptionWhenMinimunAndMaximunAgeFails()
    {
        $rule = new Age(18, 50);
        $rule->assert('today');
    }
}
