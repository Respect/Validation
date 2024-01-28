<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(AbstractFilterRule::class)]
#[CoversClass(Vowel::class)]
final class VowelTest extends RuleTestCase
{
    /**
     * @return array<array{Vowel, mixed}>
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
     * @return array<array{Vowel, mixed}>
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
