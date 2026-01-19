<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Tomasz Regdos <tomek@regdos.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Pesel::class)]
final class PeselTest extends RuleTestCase
{
    /** @return iterable<array{Pesel, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Pesel();

        return [
            [$validator, 0x4EADCD168], // 0x4EADCD168 === 21120209256
            [$validator, 49040501580],
            [$validator, '49040501580'],
            [$validator, '39012110375'],
            [$validator, '50083014540'],
            [$validator, '69090515504'],
            [$validator, '21120209256'],
            [$validator, '01320613891'],
        ];
    }

    /** @return iterable<array{Pesel, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Pesel();

        return [
            [$validator, null],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, '1'],
            [$validator, '22'],
            [$validator, 'PESEL'],
            [$validator, '0x4EADCD168'],
            [$validator, 'PESEL123456'],
            [$validator, '690905155.4'],
            [$validator, '21120209251'],
            [$validator, '21120209250'],
            [$validator, '01320613890'],
        ];
    }
}
