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
 * @covers \Respect\Validation\Rules\EndsWith
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class EndsWithTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new EndsWith('foo'), ['bar', 'foo']],
            [new EndsWith('foo'), 'barbazFOO'],
            [new EndsWith('foo'), 'barbazfoo'],
            [new EndsWith('foo'), 'foobazfoo'],
            [new EndsWith('1'), [2, 3, 1]],
            [new EndsWith(1), [2, 3, 1]],
            [new EndsWith('1', true), [2, 3, '1']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new EndsWith('foo'), ''],
            [new EndsWith('bat'), ['bar', 'foo']],
            [new EndsWith('foo'), 'barfaabaz'],
            [new EndsWith('foo', true), 'barbazFOO'],
            [new EndsWith('foo'), 'faabarbaz'],
            [new EndsWith('foo'), 'baabazfaa'],
            [new EndsWith('foo'), 'baafoofaa'],
            [new EndsWith('1', true), [1, '1', 3]],
        ];
    }
}
