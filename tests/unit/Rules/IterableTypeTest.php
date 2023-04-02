<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\IterableType
 *
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IterableTypeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new stdClass()],
            [$rule, new ArrayIterator()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, 3],
            [$rule, 'asdf'],
            [$rule, 9.85],
            [$rule, null],
            [$rule, true],
        ];
    }
}
