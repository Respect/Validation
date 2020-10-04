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
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\HexRgbColor
 *
 * @author Davide Pastore <pasdavide@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class HexRgbColorTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
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

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
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
