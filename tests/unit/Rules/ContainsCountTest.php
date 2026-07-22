<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\ContainsCount
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ContainsCountTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            'three "a" in a string' => [new ContainsCount('a', 3), 'banana'],
            'single occurrence in a string' => [new ContainsCount('x', 1), 'example'],
            'multi-byte needle' => [new ContainsCount('á', 2), 'áéíóúá'],
            'value once in an array' => [new ContainsCount('foo', 1), ['bar', 'foo']],
            'value twice in an array' => [new ContainsCount('foo', 2), ['foo', 'bar', 'foo']],
            'strict integer in an array' => [new ContainsCount(1, 1), [2, 3, 1]],
            'zero occurrences in a string' => [new ContainsCount('z', 0), 'banana'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            'wrong count in a string' => [new ContainsCount('a', 2), 'banana'],
            'needle absent from a string' => [new ContainsCount('z', 1), 'banana'],
            'wrong count in an array' => [new ContainsCount('foo', 1), ['foo', 'foo']],
            'loose comparison is not used for arrays' => [new ContainsCount('1', 1), [2, 3, 1]],
            'empty needle' => [new ContainsCount('', 1), 'banana'],
            'non-scalar needle with scalar input' => [new ContainsCount(new stdClass(), 1), 'banana'],
            'non-scalar and non-array input' => [new ContainsCount('a', 1), new stdClass()],
        ];
    }
}
