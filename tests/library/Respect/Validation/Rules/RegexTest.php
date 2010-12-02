<?php

namespace Respect\Validation\Rules;

class RegexTest extends \PHPUnit_Framework_TestCase
{

    public function testRegexOk()
    {
        $v = new Regex('w+');
        $this->assertTrue($v->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testRegexNot()
    {
        $v = new Regex('^w+$');
        $this->assertTrue($v->assert('w poiur'));
    }

}