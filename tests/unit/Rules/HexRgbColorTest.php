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

use Respect\Validation\Test\TestCase;
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\HexRgbColorException
 * @covers \Respect\Validation\Rules\HexRgbColor
 *
 * @author Davide Pastore <pasdavide@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class HexRgbColorTest extends TestCase
{
    /**
     * @dataProvider providerForValidHexRgbColor
     *
     * @test
     */
    public function hexRgbColorValuesOnlyShouldReturnTrue(string $input): void
    {
        $validator = new HexRgbColor();

        self::assertTrue($validator->validate($input));
    }

    /**
     * @dataProvider providerForInvalidHexRgbColor
     *
     * @test
     *
     * @param mixed $input
     */
    public function invalidHexRgbColorValuesShouldReturnFalse($input): void
    {
        $validator = new HexRgbColor();

        self::assertFalse($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerForValidHexRgbColor(): array
    {
        return [
            ['#000'],
            ['#00000F'],
            ['#123'],
            ['#123456'],
            ['#FFFFFF'],
            ['123123'],
            ['FFFFFF'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidHexRgbColor(): array
    {
        return [
            ['#0'],
            ['#0000G0'],
            ['#0FG'],
            ['#1234'],
            ['#AAAAAA1'],
            ['#S'],
            ['1234'],
            ['foo'],
            [0x39F],
            [05],
            [1],
            [443],
            [[]],
            [new stdClass()],
            [null],
        ];
    }
}
