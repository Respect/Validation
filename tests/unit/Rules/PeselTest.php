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
 * @covers \Respect\Validation\Rules\Pesel
 */
final class PeselTest extends RuleTestCase
{
    /**
     * @return array<array{Pesel, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Pesel();

        return [
            [$rule, 0x4EADCD168], // 0x4EADCD168 === 21120209256
            [$rule, 49040501580],
            [$rule, '49040501580'],
            [$rule, '39012110375'],
            [$rule, '50083014540'],
            [$rule, '69090515504'],
            [$rule, '21120209256'],
            [$rule, '01320613891'],
        ];
    }

    /**
     * @return array<array{Pesel, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Pesel();

        return [
            [$rule, '1'],
            [$rule, '22'],
            [$rule, 'PESEL'],
            [$rule, '0x4EADCD168'],
            [$rule, 'PESEL123456'],
            [$rule, '690905155.4'],
            [$rule, '21120209251'],
            [$rule, '21120209250'],
            [$rule, '01320613890'],
        ];
    }
}
