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
 * @covers \Respect\Validation\Rules\Min
 * @covers \Respect\Validation\Exceptions\MinException
 */
class MinTest extends TestCase
{
    /**
     * @dataProvider providerForValidMin
     */
    public function testValidMinShouldReturnTrue($minValue, $inclusive, $input): void
    {
        $min = new Min($minValue, $inclusive);
        self::assertTrue($min->__invoke($input));
        self::assertTrue($min->check($input));
        self::assertTrue($min->assert($input));
    }

    /**
     * @dataProvider providerForInvalidMin
     * @expectedException \Respect\Validation\Exceptions\MinException
     */
    public function testInvalidMinShouldThrowMinException($minValue, $inclusive, $input): void
    {
        $min = new Min($minValue, $inclusive);
        self::assertFalse($min->__invoke($input));
        self::assertFalse($min->assert($input));
    }

    public function providerForValidMin()
    {
        return [
            [100, false, 165.0],
            [-100, false, 200],
            [200, true, 200],
            [200, false, 300],
            ['a', true, 'a'],
            ['a', true, 'c'],
            ['yesterday', true, 'now'],

            // Samples from issue #178
            ['13-05-2014 03:16', true, '20-05-2014 03:16'],
            [new DateTime('13-05-2014 03:16'), true, new DateTime('20-05-2014 03:16')],
            ['13-05-2014 03:16', true, new DateTime('20-05-2014 03:16')],
            [new DateTime('13-05-2014 03:16'), true, '20-05-2014 03:16'],
        ];
    }

    public function providerForInvalidMin()
    {
        return [
            [100, true, ''],
            [100, false, ''],
            [500, false, 300],
            [0, false, -250],
            [0, false, -50],
            [50, false, 50],
        ];
    }
}
