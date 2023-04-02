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
 *
 * @covers \Respect\Validation\Rules\Uppercase
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class UppercaseTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
