<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Regex
 * @covers Respect\Validation\Exceptions\RegexException
 */
class RegexTest extends \PHPUnit_Framework_TestCase
{
    public function testRegexOk()
    {
        $v = new Regex('/^[a-z]+$/');
        $this->assertTrue($v->validate('wpoiur'));
        $this->assertFalse($v->validate('wPoiUur'));

        $v = new Regex('/^[a-z]+$/i');
        $this->assertTrue($v->validate('wPoiur'));
        $this->assertTrue($v->check('wPoiur'));
        $this->assertTrue($v->assert('wPoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\RegexException
     */
    public function testRegexNot()
    {
        $v = new Regex('/^w+$/');
        $this->assertFalse($v->validate('w poiur'));
        $this->assertFalse($v->assert('w poiur'));
    }
}
