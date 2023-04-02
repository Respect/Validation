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
 * @covers \Respect\Validation\Rules\Vowel
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class VowelTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $sut = new Vowel();

        return [
            [$sut, 'a'],
            [$sut, 'e'],
            [$sut, 'i'],
            [$sut, 'o'],
            [$sut, 'u'],
            [$sut, 'aeiou'],
            [$sut, 'uoiea'],
            [new Vowel('!@#$%^&*(){}'), '!@#$%^&*(){}aeoiu'],
            [new Vowel('[]?+=/\\-_|"\',<>.'), '[]?+=/\\-_|"\',<>.aeoiu'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new Vowel();

        return [
            [$sut, ''],
            [$sut, ' '],
            [$sut, "\n"],
            [$sut, "\t"],
            [$sut, "\r"],
            [$sut, null],
            [$sut, '16'],
            [$sut, 'F'],
            [$sut, 'g'],
            [$sut, 'Foo'],
            [$sut, -50],
            [$sut, 'basic'],
        ];
    }
}
