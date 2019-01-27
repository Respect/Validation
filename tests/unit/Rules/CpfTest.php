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
 * @covers \Respect\Validation\Rules\Cpf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jair Henrique <jair.henrique@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CpfTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Cpf();

        return [
            [$rule, '342.444.198-88'],
            [$rule, '342.444.198.88'],
            [$rule, '350.45261819'],
            [$rule, '693-319-118-40'],
            [$rule, '3.6.8.8.9.2.5.5.4.8.8'],
            [$rule, '11598647644'],
            [$rule, '86734718697'],
            [$rule, '86223423284'],
            [$rule, '24845408333'],
            [$rule, '95574461102'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Cpf();

        return [
            [$rule, ''],
            [$rule, '000.000.000-00'],
            [$rule, '111.222.444-05'],
            [$rule, '999999999.99'],
            [$rule, '8.8.8.8.8.8.8.8.8.8.8'],
            [$rule, '693-319-110-40'],
            [$rule, '698.111-111.00'],
            [$rule, '11111111111'],
            [$rule, '22222222222'],
            [$rule, '12345678900'],
            [$rule, '99299929384'],
            [$rule, '84434895894'],
            [$rule, '44242340000'],
            [$rule, '1'],
            [$rule, '22'],
            [$rule, '123'],
            [$rule, '992999999999929384'],
        ];
    }
}
