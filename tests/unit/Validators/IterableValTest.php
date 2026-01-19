<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Guilherme Siani <guilherme@siani.com.br>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: João Torquato <joao.otl@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayIterator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(IterableVal::class)]
final class IterableValTest extends RuleTestCase
{
    /** @return iterable<array{IterableVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new IterableVal();

        return [
            [$validator, [1, 2, 3]],
            [$validator, new stdClass()],
            [$validator, new ArrayIterator()],
        ];
    }

    /** @return iterable<array{IterableVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new IterableVal();

        return [
            [$validator, 3],
            [$validator, 'asdf'],
            [$validator, 9.85],
            [$validator, null],
            [$validator, true],
        ];
    }
}
