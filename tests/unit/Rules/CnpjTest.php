<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Cnpj
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <jayson.reis@sabbre.com.br>
 * @author Renato Moura <renato@naturalweb.com.br>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CnpjTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Cnpj();

        return [
            [$rule, '32.063.364/0001-07'],
            [$rule, '24.663.454/0001-00'],
            [$rule, '57.535.083/0001-30'],
            [$rule, '24.760.428/0001-09'],
            [$rule, '27.355.204/0001-00'],
            [$rule, '36.310.327/0001-07'],
            [$rule, '38175021000110'],
            [$rule, '37550610000179'],
            [$rule, '12774546000189'],
            [$rule, '77456211000168'],
            [$rule, '02023077000102'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Cnpj();

        return [
            [$rule, '12.345.678/9012-34'],
            [$rule, '11.111.111/1111-11'],
            [$rule, '00000000000000'],
            [$rule, '11111111111111'],
            [$rule, '22222222222222'],
            [$rule, '33333333333333'],
            [$rule, '44444444444444'],
            [$rule, '55555555555555'],
            [$rule, '66666666666666'],
            [$rule, '77777777777777'],
            [$rule, '88888888888888'],
            [$rule, '99999999999999'],
            [$rule, '12345678900123'],
            [$rule, '99299929384987'],
            [$rule, '84434895894444'],
            [$rule, '44242340000000'],
            [$rule, '1'],
            [$rule, '22'],
            [$rule, '123'],
            [$rule, '992999999999929384'],
            [$rule, '99-010-0.'],
        ];
    }
}
