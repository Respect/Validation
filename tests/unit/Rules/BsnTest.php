<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Bsn::class)]
final class BsnTest extends RuleTestCase
{
    /** @return iterable<array{Bsn, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Bsn();

        return [
            [$rule, '612890053'],
            [$rule, '087880532'],
            [$rule, '386625918'],
            [$rule, '601608021'],
            [$rule, '254650703'],
            [$rule, '478063441'],
            [$rule, '478063441'],
            [$rule, '187368429'],
            [$rule, '541777348'],
            [$rule, '254283883'],
        ];
    }

    /** @return iterable<array{Bsn, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Bsn();

        return [
            [$rule, '1234567890'],
            [$rule, '0987654321'],
            [$rule, '13579024'],
            [$rule, '612890054'],
            [$rule, '854650703'],
            [$rule, '283958721'],
            [$rule, '231859081'],
            [$rule, '189023323'],
            [$rule, '238150912'],
            [$rule, '382409678'],
            [$rule, '38240.678'],
            [$rule, '38240a678'],
            [$rule, 'abcdefghi'],
        ];
    }
}
