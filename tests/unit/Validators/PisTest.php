<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Bruno Koga <brunokoga187@gmail.com>
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
#[CoversClass(Pis::class)]
final class PisTest extends RuleTestCase
{
    /** @return iterable<array{Pis, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Pis();

        return [
            [$validator, '120.4454.683-5'],
            [$validator, '120.8995.084-8'],
            [$validator, '120.5146.8577'],
            [$validator, '120.01842459'],
            [$validator, '1.2.0.7.9.8.1.6.7.8.2'],
            [$validator, '12044546835'],
            [$validator, '12089950848'],
            [$validator, '12051468577'],
            [$validator, '12001842459'],
            [$validator, '12079816782'],
            [$validator, 12079816782],
        ];
    }

    /** @return iterable<array{Pis, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Pis();

        return [
            [$validator, ''],
            [$validator, '000.0000.000-0'],
            [$validator, '111.2222.444-5'],
            [$validator, '999999999.99'],
            [$validator, '8.8.8.8.8.8.8.8.8.8.8'],
            [$validator, '693-3129-110-1'],
            [$validator, '698.1131-111.2'],
            [$validator, '11111111111'],
            [$validator, '22222222222'],
            [$validator, '12345678901'],
            [$validator, '99299929384'],
            [$validator, '84434895894'],
            [$validator, '44242340002'],
            [$validator, '1'],
            [$validator, '22'],
            [$validator, '123'],
            [$validator, '992999999999929384'],
            [$validator, false],
            [$validator, []],
            [$validator, new stdClass()],
        ];
    }
}
