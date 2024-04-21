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

#[Group('rule')]
#[CoversClass(PolishIdCard::class)]
final class PolishIdCardTest extends RuleTestCase
{
    /** @return iterable<array{PolishIdCard, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new PolishIdCard();

        return [
            [$rule, 'APH505567'],
            [$rule, 'AYE205410'],
            [$rule, 'AYW036733'],
        ];
    }

    /** @return iterable<array{PolishIdCard, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new PolishIdCard();

        return [
            [$rule, null],
            [$rule, new stdClass()],
            [$rule, []],
            [$rule, '999205411'],
            [$rule, 'AAAAAAAAA'],
            [$rule, 'APH 505567'],
            [$rule, 'AYE205411'],
            [$rule, 'AYW036731'],
        ];
    }
}
