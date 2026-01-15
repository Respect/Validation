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

use function rand;

#[Group('validator')]
#[CoversClass(LogicCond::class)]
final class LogicCondTest extends RuleTestCase
{
    /** @return array<array{LogicCond, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'fail, then pass' => [new LogicCond(Stub::pass(1), Stub::pass(1)), rand()],
            'pass, then pass, else daze' => [new LogicCond(Stub::pass(1), Stub::pass(1), Stub::daze()), rand()],
            'fail, then daze, else pass' => [new LogicCond(Stub::fail(1), Stub::daze(), Stub::pass(1)), rand()],
        ];
    }

    /** @return array<array{LogicCond, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'pass, then fail' => [new LogicCond(Stub::pass(1), Stub::fail(1)), rand()],
            'pass, then fail, else daze' => [new LogicCond(Stub::pass(1), Stub::fail(1), Stub::daze()), rand()],
            'fail, then daze, else fail' => [new LogicCond(Stub::fail(1), Stub::daze(), Stub::fail(1)), rand()],
        ];
    }
}
