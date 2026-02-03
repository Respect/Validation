<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\StringFormatter\PatternFormatter;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Format::class)]
final class FormatTest extends RuleTestCase
{
    /** @return iterable<array{Format, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Format(new PatternFormatter('00-00'));

        return [
            [$validator, '12-34'],
            [$validator, '56-78'],
            [$validator, '90-12'],
        ];
    }

    /** @return iterable<array{Format, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Format(new PatternFormatter('00-00'));

        return [
            [$validator, ''],
            [$validator, '1234'],
            [$validator, '12-345'],
            [$validator, '1-23'],
            [$validator, 'ab-cd'],
            [$validator, null],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, 1234],
        ];
    }
}
