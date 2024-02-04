<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(When::class)]
final class WhenTest extends RuleTestCase
{
    /**
     * @return array<array{When, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            'all true' => [
                new When(Stub::pass(1), Stub::pass(1), Stub::pass(1)),
                true,
            ],
            'bool (when = true, then = true, else = false)' => [
                new When(Stub::pass(1), Stub::pass(1), Stub::fail(1)),
                true,
            ],
            'bool (when = false, then = true, else = true)' => [
                new When(Stub::fail(1), Stub::pass(1), Stub::pass(1)),
                true,
            ],
            'bool (when = false, then = false, else = true)' => [
                new When(Stub::fail(1), Stub::fail(1), Stub::pass(1)),
                true,
            ],
            'bool (when = false, then = true, else = null)' => [
                new When(Stub::pass(1), Stub::pass(1), null),
                true,
            ],
        ];
    }

    /**
     * @return array<array{When, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            'bool (when = true, then = false, else = false)' => [
                new When(Stub::pass(1), Stub::fail(1), Stub::fail(1)),
                false,
            ],
            'bool (when = true, then = false, else = true)' => [
                new When(Stub::pass(1), Stub::fail(1), Stub::pass(1)),
                false,
            ],
            'bool (when = false, then = false, else = false)' => [
                new When(Stub::fail(1), Stub::fail(1), Stub::fail(1)),
                false,
            ],
            'bool (when = true, then = false, else = null)' => [
                new When(Stub::pass(1), Stub::fail(1), null),
                false,
            ],
        ];
    }
}
