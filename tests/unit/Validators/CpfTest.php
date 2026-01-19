<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jair Henrique <jair.henrique@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Paulo Dias <prmdjweb@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Cpf::class)]
final class CpfTest extends RuleTestCase
{
    /** @return iterable<array{Cpf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Cpf();

        return [
            [$validator, '342.444.198-88'],
            [$validator, '342.444.198.88'],
            [$validator, '350.45261819'],
            [$validator, '693-319-118-40'],
            [$validator, '3.6.8.8.9.2.5.5.4.8.8'],
            [$validator, '11598647644'],
            [$validator, '86734718697'],
            [$validator, '86223423284'],
            [$validator, '24845408333'],
            [$validator, '95574461102'],
        ];
    }

    /** @return iterable<array{Cpf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Cpf();

        return [
            [$validator, ''],
            [$validator, '01234567890'],
            [$validator, '000.000.000-00'],
            [$validator, '111.222.444-05'],
            [$validator, '999999999.99'],
            [$validator, '8.8.8.8.8.8.8.8.8.8.8'],
            [$validator, '693-319-110-40'],
            [$validator, '698.111-111.00'],
            [$validator, '11111111111'],
            [$validator, '22222222222'],
            [$validator, '12345678900'],
            [$validator, '99299929384'],
            [$validator, '84434895894'],
            [$validator, '44242340000'],
            [$validator, '1'],
            [$validator, '22'],
            [$validator, '123'],
            [$validator, '992999999999929384'],
        ];
    }
}
