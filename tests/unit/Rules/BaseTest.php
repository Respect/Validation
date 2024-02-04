<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Base::class)]
final class BaseTest extends RuleTestCase
{
    /** @return iterable<array{Base, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Base(2), '011010001'],
            [new Base(3), '0120122001'],
            [new Base(8), '01234567520'],
            [new Base(16), '012a34f5675c20d'],
            [new Base(20), '012ah34f5675hic20dj'],
            [new Base(50), '012ah34f56A75FGhic20dj'],
            [new Base(62), 'Z01xSsg5675hic20dj'],
            [new Base(2, 'xy'), 'xyyxyxxy'],
            [new Base(3, 'pfg'), 'gfpffp'],
        ];
    }

    /** @return iterable<array{Base, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Base(2), ''],
            [new Base(3), ''],
            [new Base(8), ''],
            [new Base(16), ''],
            [new Base(20), ''],
            [new Base(50), ''],
            [new Base(62), ''],
            [new Base(2), '01210103001'],
            [new Base(3), '0120125f2001'],
            [new Base(8), '01234dfZ567520'],
            [new Base(16), '012aXS34f5675c20d'],
            [new Base(20), '012ahZX34f5675hic20dj'],
            [new Base(50), '012ahGZ34f56A75FGhic20dj'],
            [new Base(61), 'Z01xSsg5675hic20dj'],
        ];
    }
}
