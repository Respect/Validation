<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
    public function providerForValidInput(): array
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
    public function providerForInvalidInput(): array
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
