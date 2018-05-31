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
final class ContainsTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Contains('foo', false), ['bar', 'foo']],
            [new Contains('foo', false), 'barbazFOO'],
            [new Contains('foo', false), 'barbazfoo'],
            [new Contains('foo', false), 'foobazfoO'],
            [new Contains('1', false), [2, 3, 1]],
            [new Contains('1', false), [2, 3, '1']],
            [new Contains('foo'), ['fool', 'foo']],
            [new Contains('foo'), 'barbazfoo'],
            [new Contains('foo'), 'foobazfoo'],
            [new Contains('1'), [2, 3, (string) 1]],
            [new Contains('1'), [2, 3, '1']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Contains('foo', false), ''],
            [new Contains('bat', false), ['bar', 'foo']],
            [new Contains('foo', false), 'barfaabaz'],
            [new Contains('foo', false), 'faabarbaz'],
            [new Contains('foo', true), ''],
            [new Contains('bat', true), ['BAT', 'foo']],
            [new Contains('bat', true), ['BaT', 'Batata']],
            [new Contains('foo', true), 'barfaabaz'],
            [new Contains('foo', true), 'barbazFOO'],
            [new Contains('foo', true), 'faabarbaz'],
        ];
    }
}
