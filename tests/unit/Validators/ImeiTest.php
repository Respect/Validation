<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Diego Oliveira <contato@diegoholiveira.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Imei::class)]
final class ImeiTest extends RuleTestCase
{
    /** @return iterable<array{Imei, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Imei();

        return [
            [$validator, '35-007752-323751-3'],
            [$validator, '35-209900-176148-1'],
            [$validator, '350077523237513'],
            [$validator, '356938035643809'],
            [$validator, '490154203237518'],
            [$validator, 350077523237513],
            [$validator, 356938035643809],
            [$validator, 490154203237518],
        ];
    }

    /** @return iterable<array{Imei, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Imei();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 1.0],
            [$validator, new stdClass()],
            [$validator, '490154203237512'],
            [$validator, '4901542032375125'],
            [$validator, 'Whateveeeeeerrr'],
            [$validator, true],
        ];
    }
}
