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
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Punct
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class PunctTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $sut = new Punct();

        return [
            [$sut, '.'],
            [$sut, ',;:'],
            [$sut, '-@#$*'],
            [$sut, '()[]{}'],
            [new Punct('abc123 '), '!@#$%^&*(){} abc 123'],
            [new Punct("abc123 \t\n"), "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new Punct();

        return [
            [$sut, ''],
            [$sut, '16-50'],
            [$sut, 'a'],
            [$sut, ' '],
            [$sut, 'Foo'],
            [$sut, '12.1'],
            [$sut, '-12'],
            [$sut, -12],
            [$sut, '( )_{}'],
        ];
    }
}
