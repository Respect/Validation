<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
    public function providerForValidInput(): array
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
    public function providerForInvalidInput(): array
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
