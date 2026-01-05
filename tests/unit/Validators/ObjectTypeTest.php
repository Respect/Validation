<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
