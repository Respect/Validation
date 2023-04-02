<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractComparison
 * @covers \Respect\Validation\Rules\LessThan
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LessThanTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new LessThan(10), 9],
            [new LessThan('2010-01-01'), '2000-01-01'],
            [new LessThan('today'), '3 days ago'],
            [new LessThan('b'), 'a'],
            [new LessThan(new CountableStub(5)), 4],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new LessThan(10), 10],
            [new LessThan('2010-01-01'), '2020-01-01'],
            [new LessThan('yesterday'), 'tomorrow'],
            [new LessThan('a'), 'z'],
            [new LessThan(new CountableStub(5)), 6],
            [new LessThan(1900), '2018-01-25'],
            [new LessThan(10.5), '2018-01-25'],
        ];
    }
}
