<?php

namespace Respect\Validation\Rules;

class VersionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidVersion
     */
    public function test_valid_version_should_return_true($input)
    {
        $rule = new Version();
        $this->assertTrue($rule->validate($input));
        $this->assertTrue($rule->assert($input));
        $this->assertTrue($rule->check($input));
    }

    /**
     * @dataProvider providerForInvalidVersion
     * @expectedException Respect\Validation\Exceptions\VersionException
     */
    public function test_invalid_version_should_throw_exception($input)
    {
        $rule = new Version();
        $this->assertFalse($rule->validate($input));
        $this->assertFalse($rule->assert($input));
    }

    public function providerForValidVersion()
    {
        return array(
            array('1.0.0'),
            array('1.0.0-alpha'),
            array('1.0.0-alpha.1'),
            array('1.0.0-0.3.7'),
            array('1.0.0-x.7.z.92'),
            array('1.3.7+build.2.b8f12d7'),
            array('1.3.7-rc.1'),
        );
    }

    public function providerForInvalidVersion()
    {
        return array(
            array('1.3.7--'),
            array('1.3.7++'),
            array('foo'),
            array('1.2.3.4'),
            array('1.2.3.4-beta'),
            array('beta'),
        );
    }

}