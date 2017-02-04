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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\HexRgbColor
 * @covers \Respect\Validation\Exceptions\HexRgbColorException
 */
class HexRgbColorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidHexRgbColor
     */
    public function testHexRgbColorValuesONLYShouldReturnTrue($validHexRgbColor)
    {
        $validator = new HexRgbColor();

        $this->assertTrue($validator->validate($validHexRgbColor));
    }

    /**
     * @dataProvider providerForInvalidHexRgbColor
     */
    public function testInvalidHexRgbColorValuesShouldReturnFalse($invalidHexRgbColor)
    {
        $validator = new HexRgbColor();

        $this->assertFalse($validator->validate($invalidHexRgbColor));
    }

    public function providerForValidHexRgbColor()
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

    public function providerForInvalidHexRgbColor()
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
            [new \stdClass()],
            [null],
        ];
    }
}
