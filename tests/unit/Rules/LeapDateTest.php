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
use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\LeapDate
 * @covers \Respect\Validation\Exceptions\LeapDateException
 */
class LeapDateTest extends TestCase
{
    protected $leapDateValidator;

    protected function setUp()
    {
        $this->leapDateValidator = new LeapDate('Y-m-d');
    }

    public function testValidLeapDate_with_string()
    {
        self::assertTrue($this->leapDateValidator->validate('1988-02-29'));
    }

    public function testValidLeapDate_with_date_time()
    {
        self::assertTrue($this->leapDateValidator->validate(
            new DateTime('1988-02-29')));
    }

    public function testInvalidLeapDate_with_string()
    {
        self::assertFalse($this->leapDateValidator->validate('1989-02-29'));
    }

    public function testInvalidLeapDate_with_date_time()
    {
        self::assertFalse($this->leapDateValidator->validate(
            new DateTime('1989-02-29')));
    }
    public function testInvalidLeapDate_input()
    {
        self::assertFalse($this->leapDateValidator->validate([]));
    }
}
