<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\When
 */
final class WhenTest extends RuleTestCase
{
    /**
     * @return array<array{When, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            'all true' => [
                new When(
                    new AlwaysValid(),
                    new AlwaysValid(),
                    new AlwaysValid()
                ),
                true,
            ],
            'bool (when = true, then = true, else = false)' => [
                new When(
                    new AlwaysValid(),
                    new AlwaysValid(),
                    new AlwaysInvalid()
                ),
                true,
            ],
            'bool (when = false, then = true, else = true)' => [
                new When(
                    new AlwaysInvalid(),
                    new AlwaysValid(),
                    new AlwaysValid()
                ),
                true,
            ],
            'bool (when = false, then = false, else = true)' => [
                new When(
                    new AlwaysInvalid(),
                    new AlwaysInvalid(),
                    new AlwaysValid()
                ),
                true,
            ],
            'bool (when = false, then = true, else = null)' => [
                new When(
                    new AlwaysValid(),
                    new AlwaysValid(),
                    null
                ),
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
                new When(
                    new AlwaysValid(),
                    new AlwaysInvalid(),
                    new AlwaysInvalid()
                ),
                false,
            ],
            'bool (when = true, then = false, else = true)' => [
                new When(
                    new AlwaysValid(),
                    new AlwaysInvalid(),
                    new AlwaysValid()
                ),
                false,
            ],
            'bool (when = false, then = false, else = false)' => [
                new When(
                    new AlwaysInvalid(),
                    new AlwaysInvalid(),
                    new AlwaysInvalid()
                ),
                false,
            ],
            'bool (when = true, then = false, else = null)' => [
                new When(
                    new AlwaysValid(),
                    new AlwaysInvalid(),
                    null
                ),
                false,
            ],
        ];
    }
}
