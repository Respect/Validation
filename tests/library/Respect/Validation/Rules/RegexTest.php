<?php

namespace Respect\Validation\Rules;

class RegexTest extends \PHPUnit_Framework_TestCase
{

    public function testRegexOk()
    {
        $v = new Regex('/^[a-z]+$/');
        $this->assertTrue($v->validate('wpoiur'));
        $this->assertFalse($v->validate('wPoiUur'));

        $v = new Regex('/^[a-z]+$/i');
        $this->assertTrue($v->validate('wPoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\RegexException
     */
    public function testRegexNot()
    {
        $v = new Regex('/^w+$/');
        $this->assertTrue($v->assert('w poiur'));
    }

}