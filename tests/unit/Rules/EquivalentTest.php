<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Equivalent
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class EquivalentTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Equivalent(1), true],
            [new Equivalent('Something'), 'something'],
            [new Equivalent([1, 2, 3]), [1, 2, 3]],
            [new Equivalent((object) ['foo' => 'bar']), (object) ['foo' => 'bar']],
            [new Equivalent(new ArrayObject([1, 2, 3, 4, 5])), new ArrayObject([1, 2, 3, 4, 5])],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Equivalent(1), false],
            [new Equivalent('Something'), 'something else'],
            [new Equivalent([1, 2, 3]), [1, 2, 3, 4]],
            [new Equivalent((object) ['foo' => 'bar']), (object) ['foo' => 42]],
        ];
    }
}
