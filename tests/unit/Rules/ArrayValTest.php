<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SimpleXMLElement;
use stdClass;

#[Group(' rule')]
#[CoversClass(ArrayVal::class)]
final class ArrayValTest extends RuleTestCase
{
    /** @return iterable<array{ArrayVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new ArrayVal();

        return [
            [$validator, []],
            [$validator, [1, 2, 3]],
            [$validator, new ArrayObject()],
            [$validator, new SimpleXMLElement('<foo></foo>')],
        ];
    }

    /** @return iterable<array{ArrayVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new ArrayVal();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 121],
            [$validator, new stdClass()],
            [$validator, false],
            [$validator, 'aaa'],
        ];
    }
}
