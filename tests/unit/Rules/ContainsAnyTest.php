<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Contains
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nawarian <nickolas@phpsp.org.br>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class ContainsAnyTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new ContainsAny(['foo'], false), ['foo', 'bar']],
            [new ContainsAny(['foo', 'bar'], false), ['foo', 'baz']],
            [new ContainsAny(['foo', 'bar'], false), ['bar', 'baz']],
            [new ContainsAny(['foo'], true), ['foo', 'bar']],
            [new ContainsAny(['foo', 'bar'], true), ['foo', 'baz']],
            [new ContainsAny(['foo', 'bar'], true), ['bar', 'baz']],
            [new ContainsAny([1], false), [1,2,3]],
            [new ContainsAny([1], true), [1,2,3]],
            [new ContainsAny([5, 1], false), [1,2,3]],
            [new ContainsAny([5, 1], true), [1,2,3]],
            [new ContainsAny([5, '1'], false), [1,2,3]],
            [new ContainsAny([5, '1'], false), ['1','2','3']],
            [new ContainsAny([5, '1'], true), ['1','2','3']],
            [new ContainsAny([5, 1], false), ['1','2','3']],

            [new ContainsAny([2], false), '123'],
            [new ContainsAny([2], true), '123'],

            [new ContainsAny(['foo', 'qux']), 'foobarbaz'],
            [new ContainsAny(['foo', 'qux']), 'barbazfoo'],
            [new ContainsAny(['foo', 'qux']), 'barbazFOO'],
            [new ContainsAny(['foo', 'qux']), 'barbazqUx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new ContainsAny(['foo'], false), ['bar', 'baz']],
            [new ContainsAny(['foo', 'bar'], false), ['baz', 'qux']],
            [new ContainsAny(['foo', 'bar'], false), ['FOO', 'BAR']],
            [new ContainsAny(['foo'], true), ['bar', 'baz']],
            [new ContainsAny(['foo', 'bar'], true), ['baz', 'qux']],
            [new ContainsAny(['foo', 'bar'], true), ['FOO', 'BAR']],
            [new ContainsAny([5], false), [1,2,3]],
            [new ContainsAny([5], true), [1,2,3]],
            [new ContainsAny([5, 1], false), [2,3]],
            [new ContainsAny([5, 1], true), [2,3]],
            [new ContainsAny([5, '1'], true), [1,2,3]],
            [new ContainsAny([5, '1'], true), ['5',1,'3']],
            [new ContainsAny([5, '1'], false), []],
            [new ContainsAny([5, '1'], true), []],

            [new ContainsAny([5], false), '123'],
            [new ContainsAny([5], true), '123'],

            [new ContainsAny(['foo']), ''],
            [new ContainsAny(['foo']), 'barbaz'],
            [new ContainsAny(['foo']), 'barbaz'],
            [new ContainsAny(['foo', 'qux']), ''],
            [new ContainsAny(['foo', 'qux']), 'barbaz'],
            [new ContainsAny(['foo', 'qux']), 'barbaz'],
        ];
    }
}
