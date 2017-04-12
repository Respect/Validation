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
 * @covers \Respect\Validation\Rules\LeapDate
 * @covers \Respect\Validation\Exceptions\LeapDateException
 */
class LeapDateTest extends \PHPUnit_Framework_TestCase
{
    protected $leapDateValidator;

    protected function setUp()
    {
        $this->leapDateValidator = new LeapDate('Y-m-d');
    }

    public function testValidLeapDate_with_string()
    {
        $this->assertTrue($this->leapDateValidator->validate('1988-02-29'));
    }

    public function testValidLeapDate_with_date_time()
    {
        $this->assertTrue($this->leapDateValidator->validate(
            new DateTime('1988-02-29')));
    }

    public function testInvalidLeapDate_with_string()
    {
        $this->assertFalse($this->leapDateValidator->validate('1989-02-29'));
    }

    public function testInvalidLeapDate_with_date_time()
    {
        $this->assertFalse($this->leapDateValidator->validate(
            new DateTime('1989-02-29')));
    }
    public function testInvalidLeapDate_input()
    {
        $this->assertFalse($this->leapDateValidator->validate([]));
    }
}
