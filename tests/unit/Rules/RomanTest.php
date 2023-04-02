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
 *
 * @covers \Respect\Validation\Rules\Roman
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class RomanTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
