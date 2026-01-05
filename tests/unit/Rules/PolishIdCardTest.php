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

#[Group('validator')]
#[CoversClass(PolishIdCard::class)]
final class PolishIdCardTest extends RuleTestCase
{
    /** @return iterable<array{PolishIdCard, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PolishIdCard();

        return [
            [$validator, 'APH505567'],
            [$validator, 'AYE205410'],
            [$validator, 'AYW036733'],
        ];
    }

    /** @return iterable<array{PolishIdCard, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PolishIdCard();

        return [
            [$validator, null],
            [$validator, new stdClass()],
            [$validator, []],
            [$validator, '999205411'],
            [$validator, 'AAAAAAAAA'],
            [$validator, 'APH 505567'],
            [$validator, 'AYE205411'],
            [$validator, 'AYW036731'],
        ];
    }
}
