<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use ArrayObject;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\ArrayType
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author João Torquato <joao.otl@gmail.com>
 */
final class ArrayTypeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new ArrayType();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new ArrayType();

        return [
            [$rule, 'test'],
            [$rule, 1],
            [$rule, 1.0],
            [$rule, true],
            [$rule, new ArrayObject()],
            [$rule, new ArrayIterator()],
        ];
    }
}
