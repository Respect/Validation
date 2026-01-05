<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(StringType::class)]
final class StringTypeTest extends RuleTestCase
{
    /** @return iterable<array{StringType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new StringType();

        return [
            [$validator, ''],
            [$validator, '165.7'],
        ];
    }

    /** @return iterable<array{StringType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new StringType();

        return [
            [$validator, null],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, 150],
        ];
    }
}
