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
 * @covers \Respect\Validation\Rules\ContainsAny
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kirill Dlussky <kirill@dlussky.ru>
 */
final class ContainsAnyTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new ContainsAny(['Something', 'Else']), 'something else'],
            [new ContainsAny([true]), [1, 2, 3]],
            [new ContainsAny([true], true), [true]],
            [new ContainsAny(['1']), [1, 2, 3]],
            [new ContainsAny([1], true), [1, 2, 3]],
            [new ContainsAny(['word', '@', '/']), 'lorem ipsum @ word'],
            [new ContainsAny(['foo', 'qux']), 'foobarbaz'],
            [new ContainsAny(['1']), ['foo', 1]],
            [new ContainsAny(['foo', true]), ['foo', 'bar']],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new ContainsAny(['foo']), ['bar', 'baz']],
            [new ContainsAny(['foo', 'bar']), ['baz', 'qux']],
            [new ContainsAny(['foo', 'bar']), ['FOO', 'BAR']],
            [new ContainsAny(['foo'], true), ['bar', 'baz']],
            [new ContainsAny(['foo', 'bar'], true), ['FOO', 'BAR']],
            [new ContainsAny(['whatever']), ''],
            [new ContainsAny(['']), 'whatever'],
            [new ContainsAny([false]), ''],
            [new ContainsAny(['foo', 'qux']), 'barbaz'],
            [new ContainsAny([1, 2, 3], true), ['1', '2', '3']],
            [new ContainsAny(['word', '@', '/']), 'lorem ipsum'],
        ];
    }
}
