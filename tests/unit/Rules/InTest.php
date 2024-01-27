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
 * @covers \Respect\Validation\Rules\In
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class InTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new In(''), ''],
            [new In([null]), null],
            [new In(['0']), '0'],
            [new In([0]), 0],
            [new In(['foo', 'bar']), 'foo'],
            [new In('barfoobaz'), 'foo'],
            [new In('foobarbaz'), 'foo'],
            [new In('barbazfoo'), 'foo'],
            [new In([1, 2, 3]), '1'],
            [new In(['1', 2, 3], true), '1'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new In('0'), null],
            [new In(0, true), null],
            [new In('', true), null],
            [new In([], true), null],
            [new In('barfoobaz'), ''],
            [new In('barfoobaz'), null],
            [new In('barfoobaz'), 0],
            [new In('barfoobaz'), '0'],
            [new In(['foo', 'bar']), 'bat'],
            [new In('barfaabaz'), 'foo'],
            [new In('faabarbaz'), 'foo'],
            [new In('baabazfaa'), 'foo'],
            [new In([1, 2, 3], true), '1'],
        ];
    }
}
