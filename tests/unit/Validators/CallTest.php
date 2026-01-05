<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(Call::class)]
final class CallTest extends RuleTestCase
{
    /** @return iterable<string, array{Call, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'valid rule and valid callable' => [new Call('trim', Stub::pass(1)), ' input '],
        ];
    }

    /** @return iterable<string, array{Call, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'PHP error' => [new Call('trim', Stub::pass(1)), []],
            'exception' => [new Call(static fn() => throw new Exception(), Stub::pass(1)), []],
        ];
    }
}
