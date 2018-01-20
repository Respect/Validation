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
 * @covers \Respect\Validation\Rules\LeapYear
 * @covers \Respect\Validation\Exceptions\LeapYearException
 */
class LeapYearTest extends TestCase
{
    protected $leapYearValidator;

    protected function setUp(): void
    {
        $this->leapYearValidator = new LeapYear();
    }

    public function testValidLeapDate(): void
    {
        self::assertTrue($this->leapYearValidator->__invoke('2008'));
        self::assertTrue($this->leapYearValidator->__invoke('2008-02-29'));
        self::assertTrue($this->leapYearValidator->__invoke(2008));
        self::assertTrue($this->leapYearValidator->__invoke(
            new DateTime('2008-02-29')));
    }

    public function testInvalidLeapDate(): void
    {
        self::assertFalse($this->leapYearValidator->__invoke(''));
        self::assertFalse($this->leapYearValidator->__invoke('2009'));
        self::assertFalse($this->leapYearValidator->__invoke('2009-02-29'));
        self::assertFalse($this->leapYearValidator->__invoke(2009));
        self::assertFalse($this->leapYearValidator->__invoke(
            new DateTime('2009-02-29')));
        self::assertFalse($this->leapYearValidator->__invoke([]));
    }
}
