<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kleber Hamada Sato <kleberhs007@yahoo.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Vowel::class)]
final class VowelTest extends RuleTestCase
{
    /** @return iterable<array{Vowel, mixed}> */
    public static function providerForValidInput(): iterable
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

    /** @return iterable<array{Vowel, mixed}> */
    public static function providerForInvalidInput(): iterable
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
