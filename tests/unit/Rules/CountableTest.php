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
use stdClass;

use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Countable
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author João Torquato <joao.otl@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CountableTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Countable();

        return [
            [$rule, []],
            [$rule, new ArrayObject()],
            [$rule, new ArrayIterator()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Countable();

        return [
            [$rule, '1'],
            [$rule, 1.0],
            [$rule, new stdClass()],
            [$rule, PHP_INT_MAX],
            [$rule, true],
        ];
    }
}
