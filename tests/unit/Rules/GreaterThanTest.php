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
 * @covers \Respect\Validation\Rules\GreaterThan
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GreaterThanTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new GreaterThan(10), 11],
            [new GreaterThan('2010-01-01'), '2020-01-01'],
            [new GreaterThan('yesterday'), 'now'],
            [new GreaterThan('A'), 'B'],
            [new GreaterThan(new CountableStub(3)), 4],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new GreaterThan(10), 9],
            [new GreaterThan('2010-01-01'), '2000-01-01'],
            [new GreaterThan('18 years ago'), '5 days later'],
            [new GreaterThan('c'), 'a'],
            [new GreaterThan(new CountableStub(3)), 3],
            [new GreaterThan(1900), '2018-01-25'],
            [new GreaterThan(10.5), '2018-01-25'],
        ];
    }
}
