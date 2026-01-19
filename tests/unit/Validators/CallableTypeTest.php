<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\WithMethods;
use stdClass;

use const INF;

#[Group('validator')]
#[CoversClass(CallableType::class)]
final class CallableTypeTest extends RuleTestCase
{
    /** @return iterable<array{CallableType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new CallableType();

        return [
            [$validator, static fn() => null],
            [$validator, 'trim'],
            [$validator, WithMethods::class . '::publicStaticMethod'],
            [$validator, [new WithMethods(), 'publicMethod']],
        ];
    }

    /** @return iterable<array{CallableType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new CallableType();

        return [
            [$validator, ' '],
            [$validator, INF],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, null],
        ];
    }
}
