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
    public function providerForValidInput(): array
    {
        return [
            'all true' => [
                new When(
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(true)
                ),
                true,
            ],
            'bool (when = true, then = true, else = false)' => [
                new When(
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(false)
                ),
                true,
            ],
            'bool (when = false, then = true, else = true)' => [
                new When(
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(true)
                ),
                true,
            ],
            'bool (when = false, then = false, else = true)' => [
                new When(
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(true)
                ),
                true,
            ],
            'bool (when = false, then = true, else = null)' => [
                new When(
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(true),
                    null
                ),
                true,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'bool (when = true, then = false, else = false)' => [
                new When(
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(false)
                ),
                false,
            ],
            'bool (when = true, then = false, else = true)' => [
                new When(
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(true)
                ),
                false,
            ],
            'bool (when = false, then = false, else = false)' => [
                new When(
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(false),
                    $this->createValidatableMock(false)
                ),
                false,
            ],
            'bool (when = true, then = false, else = null)' => [
                new When(
                    $this->createValidatableMock(true),
                    $this->createValidatableMock(false),
                    null
                ),
                false,
            ],
        ];
    }
}
