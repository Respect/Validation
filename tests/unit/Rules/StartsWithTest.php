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
 * @covers \Respect\Validation\Rules\StartsWith
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class StartsWithTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new StartsWith('foo'), ['foo', 'bar']],
            [new StartsWith('foo') ,'FOObarbaz'],
            [new StartsWith('foo') , 'foobarbaz'],
            [new StartsWith('foo') ,'foobazfoo'],
            [new StartsWith('1'), [1, 2, 3]],
            [new StartsWith('1', true), ['1', 2, 3]],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new StartsWith('foo'), ''],
            [new StartsWith('bat'), ['foo', 'bar']],
            [new StartsWith('foo'), 'barfaabaz'],
            [new StartsWith('foo', true), 'FOObarbaz'],
            [new StartsWith('foo'), 'faabarbaz'],
            [new StartsWith('foo'), 'baabazfaa'],
            [new StartsWith('foo'), 'baafoofaa'],
            [new StartsWith('1', true), [1, '1', 3]],
        ];
    }
}
