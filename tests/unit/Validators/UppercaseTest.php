<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Uppercase::class)]
final class UppercaseTest extends RuleTestCase
{
    /** @return iterable<array{Uppercase, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Uppercase();

        return [
            [$validator, ''],
            [$validator, 'UPPERCASE'],
            [$validator, 'UPPERCASE-WITH-DASHES'],
            [$validator, 'UPPERCASE WITH SPACES'],
            [$validator, 'UPPERCASE WITH NUMBERS 123'],
            [$validator, 'UPPERCASE WITH SPECIALS CHARACTERS LIKE Ã Ç Ê'],
            [$validator, 'WITH SPECIALS CHARACTERS LIKE # $ % & * +'],
            [$validator, 'ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ'],
            // Uppercase should not restrict these
            [$validator, '42'],
            [$validator, '!@#$%^'],
        ];
    }

    /** @return iterable<array{Uppercase, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Uppercase();

        return [
            [$validator, 42],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, 'lowercase'],
            [$validator, 'CamelCase'],
            [$validator, 'First Character Uppercase'],
            [$validator, 'With Numbers 1 2 3'],
        ];
    }
}
