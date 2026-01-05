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
use stdClass;

use function tmpfile;

#[Group('validator')]
#[CoversClass(ScalarVal::class)]
final class ScalarValTest extends RuleTestCase
{
    /** @return iterable<array{ScalarVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new ScalarVal();

        return [
            [$validator, '6'],
            [$validator, 'String'],
            [$validator, 1.0],
            [$validator, 42],
            [$validator, false],
            [$validator, true],
        ];
    }

    /** @return iterable<array{ScalarVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new ScalarVal();

        return [
            [$validator, []],
            [
                $validator,
                static function (): void {
                },
            ],
            [$validator, new stdClass()],
            [$validator, null],
            [$validator, tmpfile()],
        ];
    }
}
