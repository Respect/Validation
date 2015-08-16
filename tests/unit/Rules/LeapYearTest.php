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

class LeapYearTest extends \PHPUnit_Framework_TestCase
{
    protected $leapYearValidator;

    protected function setUp()
    {
        $this->leapYearValidator = new LeapYear();
    }

    public function testValidLeapDate()
    {
        $this->assertTrue($this->leapYearValidator->__invoke(''));
        $this->assertTrue($this->leapYearValidator->validate(''));
        $this->assertTrue($this->leapYearValidator->__invoke('2008'));
        $this->assertTrue($this->leapYearValidator->validate('2008'));
        $this->assertTrue($this->leapYearValidator->__invoke('2008-02-29'));
        $this->assertTrue($this->leapYearValidator->validate('2008-02-29'));
        $this->assertTrue($this->leapYearValidator->__invoke(2008));
        $this->assertTrue($this->leapYearValidator->validate(2008));
        $this->assertTrue($this->leapYearValidator->__invoke(new DateTime('2008-02-29')));
        $this->assertTrue($this->leapYearValidator->validate(new DateTime('2008-02-29')));
    }

    public function testInvalidLeapDate()
    {
        $this->assertFalse($this->leapYearValidator->__invoke('2009'));
        $this->assertFalse($this->leapYearValidator->validate('2009'));
        $this->assertFalse($this->leapYearValidator->__invoke('2009-02-29'));
        $this->assertFalse($this->leapYearValidator->validate('2009-02-29'));
        $this->assertFalse($this->leapYearValidator->__invoke(2009));
        $this->assertFalse($this->leapYearValidator->validate(2009));
        $this->assertFalse($this->leapYearValidator->__invoke(new DateTime('2009-02-29')));
        $this->assertFalse($this->leapYearValidator->validate(new DateTime('2009-02-29')));
        $this->assertFalse($this->leapYearValidator->__invoke(array()));
        $this->assertFalse($this->leapYearValidator->validate(array()));
    }
}
