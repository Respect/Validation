<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\PrimeNumber
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ismael Elias <ismael.esq@hotmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 */
final class PrimeNumberTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new PrimeNumber();

        return [
            [$rule, 3],
            [$rule, 5],
            [$rule, 7],
            [$rule, '3'],
            [$rule, '5'],
            [$rule, '+7'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new PrimeNumber();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 0],
            [$rule, 10],
            [$rule, 25],
            [$rule, 36],
            [$rule, -1],
            [$rule, '-1'],
            [$rule, '25'],
            [$rule, '0'],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
        ];
    }
}
