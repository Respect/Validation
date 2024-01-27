<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\ObjectType
 */
final class ObjectTypeTest extends RuleTestCase
{
    /**
     * @return array<array{ObjectType, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new ObjectType();

        return [
            [$rule, new stdClass()],
            [$rule, new ArrayObject()],
        ];
    }

    /**
     * @return array<array{ObjectType, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new ObjectType();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 121],
            [$rule, []],
            [$rule, 'Foo'],
            [$rule, false],
        ];
    }
}
