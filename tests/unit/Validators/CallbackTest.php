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
use Respect\Validation\Test\Validators\Stub;
use stdClass;

#[Group('validator')]
#[CoversClass(Callback::class)]
final class CallbackTest extends RuleTestCase
{
    /** @return iterable<array{Callback, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Callback('is_a', 'stdClass'), new stdClass()],
            [new Callback([Stub::pass(1), 'isValid']), 'test'],
            [new Callback('is_string'), 'test'],
            [
                new Callback(static function () {
                    return true;
                }),
                'wpoiur',
            ],
        ];
    }

    /** @return iterable<array{Callback, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [
                new Callback(static function () {
                    return false;
                }),
                'w poiur',
            ],
            [
                new Callback(static function () {
                    return false;
                }),
                '',
            ],
        ];
    }
}
