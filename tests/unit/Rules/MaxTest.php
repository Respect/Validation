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
 * @covers \Respect\Validation\Rules\Max
 * @covers \Respect\Validation\Exceptions\MaxException
 */
class MaxTest extends TestCase
{
    /**
     * @dataProvider providerForValidMax
     */
    public function testValidMaxInputShouldReturnTrue($maxValue, $inclusive, $input): void
    {
        $max = new Max($maxValue, $inclusive);
        self::assertTrue($max->validate($input));
        self::assertTrue($max->check($input));
        self::assertTrue($max->assert($input));
    }

    /**
     * @dataProvider providerForInvalidMax
     * @expectedException \Respect\Validation\Exceptions\MaxException
     */
    public function testInvalidMaxValueShouldThrowMaxException($maxValue, $inclusive, $input): void
    {
        $max = new Max($maxValue, $inclusive);
        self::assertFalse($max->validate($input));
        self::assertFalse($max->assert($input));
    }

    public function providerForValidMax()
    {
        return [
            [200, false, ''],
            [200, false, 165.0],
            [200, false, -200],
            [200, true, 200],
            [200, false, 0],
            ['-18 years', true, '1988-09-09'],
            ['z', true, 'z'],
            ['z', false, 'y'],
            ['tomorrow', true, 'now'],
        ];
    }

    public function providerForInvalidMax()
    {
        return [
            [200, false, 300],
            [200, false, 250],
            [200, false, 1500],
            [200, false, 200],
        ];
    }
}
