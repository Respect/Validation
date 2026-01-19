<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: João Torquato <joao.otl@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayIterator;
use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group(' rule')]
#[CoversClass(ArrayType::class)]
final class ArrayTypeTest extends RuleTestCase
{
    /** @return iterable<array{ArrayType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new ArrayType();

        return [
            [$validator, []],
            [$validator, [1, 2, 3]],
        ];
    }

    /** @return iterable<array{ArrayType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new ArrayType();

        return [
            [$validator, 'test'],
            [$validator, 1],
            [$validator, 1.0],
            [$validator, true],
            [$validator, new ArrayObject()],
            [$validator, new ArrayIterator()],
        ];
    }
}
