<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(HexRgbColor::class)]
final class HexRgbColorTest extends RuleTestCase
{
    /** @return iterable<array{HexRgbColor, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new HexRgbColor();

        return [
            [$sut, '#000'],
            [$sut, '#00000F'],
            [$sut, '#00000f'],
            [$sut, '#123'],
            [$sut, '#123456'],
            [$sut, '#FFFFFF'],
            [$sut, '#ffffff'],
            [$sut, '123123'],
            [$sut, 'FFFFFF'],
            [$sut, 'ffffff'],
            [$sut, 443],
        ];
    }

    /** @return iterable<array{HexRgbColor, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new HexRgbColor();

        return [
            [$sut, '#0'],
            [$sut, '#0000G0'],
            [$sut, '#0FG'],
            [$sut, '#1234'],
            [$sut, '#AAAAAA1'],
            [$sut, '#S'],
            [$sut, '1234'],
            [$sut, 'foo'],
            [$sut, 05],
            [$sut, 1],
            [$sut, []],
            [$sut, new stdClass()],
            [$sut, null],
        ];
    }
}
