<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: davidepastore <pasdavide@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
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
