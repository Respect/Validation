<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(ObjectType::class)]
final class ObjectTypeTest extends RuleTestCase
{
    /** @return iterable<array{ObjectType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new ObjectType();

        return [
            [$validator, new stdClass()],
            [$validator, new ArrayObject()],
        ];
    }

    /** @return iterable<array{ObjectType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new ObjectType();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 121],
            [$validator, []],
            [$validator, 'Foo'],
            [$validator, false],
        ];
    }
}
