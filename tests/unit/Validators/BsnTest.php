<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ronald Drenth <ronalddrenth@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Bsn::class)]
final class BsnTest extends RuleTestCase
{
    /** @return iterable<array{Bsn, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Bsn();

        return [
            [$validator, '612890053'],
            [$validator, '087880532'],
            [$validator, '386625918'],
            [$validator, '601608021'],
            [$validator, '254650703'],
            [$validator, '478063441'],
            [$validator, '478063441'],
            [$validator, '187368429'],
            [$validator, '541777348'],
            [$validator, '254283883'],
        ];
    }

    /** @return iterable<array{Bsn, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Bsn();

        return [
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, null],
            [$validator, '1234567890'],
            [$validator, '0987654321'],
            [$validator, '13579024'],
            [$validator, '612890054'],
            [$validator, '854650703'],
            [$validator, '283958721'],
            [$validator, '231859081'],
            [$validator, '189023323'],
            [$validator, '238150912'],
            [$validator, '382409678'],
            [$validator, '38240.678'],
            [$validator, '38240a678'],
            [$validator, 'abcdefghi'],
        ];
    }
}
