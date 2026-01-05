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
#[CoversClass(Nip::class)]
final class NipTest extends RuleTestCase
{
    /** @return iterable<array{Nip, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Nip();

        return [
            [$validator, '1645865777'],
            [$validator, '5581418257'],
            [$validator, '1298727531'],
        ];
    }

    /** @return iterable<array{Nip, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Nip();

        return [
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, '1645865778'],
            [$validator, '164-586-57-77'],
            [$validator, '164-58-65-777'],
            [$validator, '5581418258'],
            [$validator, '1298727532'],
            [$validator, '1234567890'],
        ];
    }
}
