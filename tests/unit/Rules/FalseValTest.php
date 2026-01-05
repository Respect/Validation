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

use function random_int;

use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(FalseVal::class)]
final class FalseValTest extends RuleTestCase
{
    /** @return iterable<array{FalseVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new FalseVal();

        return [
            'boolean false' => [$sut, false],
            'empty string' => [$sut, ''],
            'integer 0' => [$sut, 0],
            '0' => [$sut, '0'],
            'false' => [$sut, 'false'],
            'FALSE' => [$sut, 'FALSE'],
            'False' => [$sut, 'False'],
            'no' => [$sut, 'no'],
            'NO' => [$sut, 'NO'],
            'No' => [$sut, 'No'],
            'off' => [$sut, 'off'],
            'OFF' => [$sut, 'OFF'],
            'Off' => [$sut, 'Off'],
        ];
    }

    /** @return iterable<array{FalseVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new FalseVal();

        return [
            'boolean true' => [$sut, true],
            'integer bigger than 1' => [$sut, random_int(1, PHP_INT_MAX)],
            'integer-string bigger than 1' => [$sut, (string) random_int(1, PHP_INT_MAX)],
            'float bigger than 0' => [$sut, 0.5],
            'true' => [$sut, 'true'],
            'on' => [$sut, 'on'],
            'yes' => [$sut, 'yes'],
            'anything' => [$sut, 'anything'],
            'empty array' => [$sut, []],
            'object' => [$sut, new stdClass()],
        ];
    }
}
