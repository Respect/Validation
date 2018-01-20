<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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

    protected function setUp(): void
    {
        $this->leapDateValidator = new LeapDate('Y-m-d');
    }

    public function testValidLeapDate_with_string(): void
    {
        self::assertTrue($this->leapDateValidator->validate('1988-02-29'));
    }

    public function testValidLeapDate_with_date_time(): void
    {
        self::assertTrue($this->leapDateValidator->validate(
            new DateTime('1988-02-29')));
    }

    public function testInvalidLeapDate_with_string(): void
    {
        self::assertFalse($this->leapDateValidator->validate('1989-02-29'));
    }

    public function testInvalidLeapDate_with_date_time(): void
    {
        self::assertFalse($this->leapDateValidator->validate(
            new DateTime('1989-02-29')));
    }

    public function testInvalidLeapDate_input(): void
    {
        self::assertFalse($this->leapDateValidator->validate([]));
    }
}
