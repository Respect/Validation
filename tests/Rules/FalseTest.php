<?php
namespace Respect\Validation\Rules;

class FalseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validFalseProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new False();

        $this->assertTrue($rule->validate($input));
    }

    public function validFalseProvider()
    {
        return array(
            array(false),
            array(0),
            array('0'),
            array('false'),
            array('off'),
            array('no'),
        );
    }

    /**
     * @dataProvider invalidFalseProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new False();

        $this->assertFalse($rule->validate($input));
    }

    public function invalidFalseProvider()
    {
        return array(
            array(true),
            array(1),
            array('1'),
            array('true'),
            array('on'),
            array('yes'),
        );
    }
}
