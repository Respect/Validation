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
 * @covers \Respect\Validation\Rules\Subset
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Singwai Chan <singwai.chan@live.com>
 */
final class SubsetTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Subset([]), []],
            [new Subset([1]), [1]],
            [new Subset([1, 1]), [1]],
            [new Subset([1]), [1, 1]],
            [new Subset([2, 1, 3]), [1, 2]],
            [new Subset([1, 2, 3]), [1, 2]],
            [new Subset(['a', 1, 2]), [1]],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Subset([]), [1]],
            [new Subset([1]), [2]],
            [new Subset([1, 2]), [1, 2, 3]],
            [new Subset(['a', 'b']), ['c']],
        ];
    }
}
