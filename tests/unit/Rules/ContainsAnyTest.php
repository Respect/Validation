<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
    public function providerForValidInput(): array
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
    public function providerForInvalidInput(): array
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
