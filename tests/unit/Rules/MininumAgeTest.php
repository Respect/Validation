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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\MinimumAge
 * @covers \Respect\Validation\Exceptions\MinimumAgeException
 */
class MininumAgeTest extends TestCase
{
    /**
     * @dataProvider providerForValidDateValidMinimumAge
     */
    public function testValidMinimumAgeInsideBoundsShouldPass($age, $format, $input): void
    {
        $minimumAge = new MinimumAge($age, $format);
        self::assertTrue($minimumAge->__invoke($input));
        self::assertTrue($minimumAge->assert($input));
        self::assertTrue($minimumAge->check($input));
    }

    /**
     * @dataProvider providerForValidDateInvalidMinimumAge
     * @expectedException \Respect\Validation\Exceptions\MinimumAgeException
     */
    public function testInvalidMinimumAgeShouldThrowException($age, $format, $input): void
    {
        $minimumAge = new MinimumAge($age, $format);
        self::assertFalse($minimumAge->__invoke($input));
        self::assertFalse($minimumAge->assert($input));
    }

    /**
     * @dataProvider providerForInvalidDate
     * @expectedException \Respect\Validation\Exceptions\MinimumAgeException
     */
    public function testInvalidDateShouldNotPass($age, $format, $input): void
    {
        $minimumAge = new MinimumAge($age, $format);
        self::assertFalse($minimumAge->__invoke($input));
        self::assertFalse($minimumAge->assert($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage The age must be a integer value
     */
    public function testShouldNotAcceptNonIntegerAgeOnConstructor(): void
    {
        new MinimumAge('L12');
    }

    public function providerForValidDateValidMinimumAge()
    {
        return [
            [18, 'Y-m-d', ''],
            [18, 'Y-m-d', '1969-07-20'],
            [18, null, new \DateTime('1969-07-20')],
            [18, 'Y-m-d', new \DateTime('1969-07-20')],
            ['18', 'Y-m-d', '1969-07-20'],
            [18.0, 'Y-m-d', '1969-07-20'],
        ];
    }

    public function providerForValidDateInvalidMinimumAge()
    {
        return [
            [18, 'Y-m-d', '2002-06-30'],
            [18, null, new \DateTime('2002-06-30')],
            [18, 'Y-m-d', new \DateTime('2002-06-30')],
        ];
    }

    public function providerForInvalidDate()
    {
        return [
            [18, null, 'invalid-input'],
            [18, null, new \stdClass()],
            [18, 'y-m-d', '2002-06-30'],
        ];
    }
}
