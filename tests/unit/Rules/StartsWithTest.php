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
 * @covers \Respect\Validation\Rules\StartsWith
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class StartsWithTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
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
    public static function providerForInvalidInput(): array
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
