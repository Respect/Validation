<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andre Ramaciotti <andre@ramaciotti.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Punct::class)]
final class PunctTest extends RuleTestCase
{
    /** @return iterable<array{Punct, mixed}> */
    public static function providerForValidInput(): iterable
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

    /** @return iterable<array{Punct, mixed}> */
    public static function providerForInvalidInput(): iterable
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
