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
use stdClass;

#[Group('rule')]
#[CoversClass(Uppercase::class)]
final class UppercaseTest extends RuleTestCase
{
    /** @return iterable<array{Uppercase, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Uppercase();

        return [
            [$rule, ''],
            [$rule, 'UPPERCASE'],
            [$rule, 'UPPERCASE-WITH-DASHES'],
            [$rule, 'UPPERCASE WITH SPACES'],
            [$rule, 'UPPERCASE WITH NUMBERS 123'],
            [$rule, 'UPPERCASE WITH SPECIALS CHARACTERS LIKE Ã Ç Ê'],
            [$rule, 'WITH SPECIALS CHARACTERS LIKE # $ % & * +'],
            [$rule, 'ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ'],
            // Uppercase should not restrict these
            [$rule, '42'],
            [$rule, '!@#$%^'],
        ];
    }

    /** @return iterable<array{Uppercase, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Uppercase();

        return [
            [$rule, 42],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, 'lowercase'],
            [$rule, 'CamelCase'],
            [$rule, 'First Character Uppercase'],
            [$rule, 'With Numbers 1 2 3'],
        ];
    }
}
