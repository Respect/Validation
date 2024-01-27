<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Roman
 */
final class RomanTest extends RuleTestCase
{
    /**
     * @return array<array{Roman, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $sut = new Roman();

        return [
            [$sut, 'III'],
            [$sut, 'IV'],
            [$sut, 'VI'],
            [$sut, 'XIX'],
            [$sut, 'XLII'],
            [$sut, 'LXII'],
            [$sut, 'CXLIX'],
            [$sut, 'CLIII'],
            [$sut, 'MCCXXXIV'],
            [$sut, 'MMXXIV'],
            [$sut, 'MCMLXXV'],
            [$sut, 'MMMMCMXCIX'],
        ];
    }

    /**
     * @return array<array{Roman, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new Roman();

        return [
            [$sut, ''],
            [$sut, ' '],
            [$sut, 'IIII'],
            [$sut, 'IVVVX'],
            [$sut, 'CCDC'],
            [$sut, 'MXM'],
            [$sut, 'XIIIIIIII'],
            [$sut, 'MIMIMI'],
        ];
    }
}
