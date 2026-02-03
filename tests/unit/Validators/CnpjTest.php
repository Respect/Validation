<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jayson Reis <santosdosreis@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Cnpj::class)]
final class CnpjTest extends RuleTestCase
{
    /** @return iterable<array{Cnpj, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Cnpj();

        return [
            [$validator, '32.063.364/0001-07'],
            [$validator, '24.663.454/0001-00'],
            [$validator, '57.535.083/0001-30'],
            [$validator, '24.760.428/0001-09'],
            [$validator, '27.355.204/0001-00'],
            [$validator, '36.310.327/0001-07'],
            [$validator, '38175021000110'],
            [$validator, '37550610000179'],
            [$validator, '12774546000189'],
            [$validator, '77456211000168'],
            [$validator, '02023077000102'],
        ];
    }

    /** @return iterable<array{Cnpj, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Cnpj();

        return [
            [$validator, '12.345.678/9012-34'],
            [$validator, '11.111.111/1111-11'],
            [$validator, '00000000000000'],
            [$validator, '11111111111111'],
            [$validator, '22222222222222'],
            [$validator, '33333333333333'],
            [$validator, '44444444444444'],
            [$validator, '55555555555555'],
            [$validator, '66666666666666'],
            [$validator, '77777777777777'],
            [$validator, '88888888888888'],
            [$validator, '99999999999999'],
            [$validator, '12345678900123'],
            [$validator, '99299929384987'],
            [$validator, '84434895894444'],
            [$validator, '44242340000000'],
            [$validator, '1'],
            [$validator, '22'],
            [$validator, '123'],
            [$validator, '992999999999929384'],
            [$validator, '99-010-0.'],
            [$validator, null],
        ];
    }
}
