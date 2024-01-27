<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Uppercase
 */
final class UppercaseTest extends RuleTestCase
{
    /**
     * @return array<array{Uppercase, mixed}>
     */
    public static function providerForValidInput(): array
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

    /**
     * @return array<array{Uppercase, mixed}>
     */
    public static function providerForInvalidInput(): array
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
