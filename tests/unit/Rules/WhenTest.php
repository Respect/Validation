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
 *
 * @covers \Respect\Validation\Rules\When
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Antonio Spinelli <tonicospinelli85@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class WhenTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
