<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(PolishIdCard::class)]
final class PolishIdCardTest extends RuleTestCase
{
    /** @return iterable<array{PolishIdCard, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PolishIdCard();

        return [
            [$validator, 'APH505567'],
            [$validator, 'AYE205410'],
            [$validator, 'AYW036733'],
        ];
    }

    /** @return iterable<array{PolishIdCard, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PolishIdCard();

        return [
            [$validator, null],
            [$validator, new stdClass()],
            [$validator, []],
            [$validator, '999205411'],
            [$validator, 'AAAAAAAAA'],
            [$validator, 'APH 505567'],
            [$validator, 'AYE205411'],
            [$validator, 'AYW036731'],
        ];
    }
}
