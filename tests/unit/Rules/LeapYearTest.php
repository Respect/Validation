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

use DateTime;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\LeapYear
 * @covers Respect\Validation\Exceptions\LeapYearException
 */
class LeapYearTest extends \PHPUnit_Framework_TestCase
{
    protected $leapYearValidator;

    protected function setUp()
    {
        $this->leapYearValidator = new LeapYear();
    }

    public function testValidLeapDate()
    {
        $this->assertTrue($this->leapYearValidator->__invoke('2008'));
        $this->assertTrue($this->leapYearValidator->__invoke('2008-02-29'));
        $this->assertTrue($this->leapYearValidator->__invoke(2008));
        $this->assertTrue($this->leapYearValidator->__invoke(
            new DateTime('2008-02-29')));
    }

    public function testInvalidLeapDate()
    {
        $this->assertFalse($this->leapYearValidator->__invoke(''));
        $this->assertFalse($this->leapYearValidator->__invoke('2009'));
        $this->assertFalse($this->leapYearValidator->__invoke('2009-02-29'));
        $this->assertFalse($this->leapYearValidator->__invoke(2009));
        $this->assertFalse($this->leapYearValidator->__invoke(
            new DateTime('2009-02-29')));
        $this->assertFalse($this->leapYearValidator->__invoke([]));
    }
}
