<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Lowercase::class)]
final class LowercaseTest extends RuleTestCase
{
    /** @return iterable<array{Lowercase, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Lowercase();

        return [
            [$validator, ''],
            [$validator, 'lowercase'],
            [$validator, 'lowercase-with-dashes'],
            [$validator, 'lowercase with spaces'],
            [$validator, 'lowercase with numbers 123'],
            [$validator, 'lowercase with specials characters like ã ç ê'],
            [$validator, 'with specials characters like # $ % & * +'],
            [$validator, 'τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός'],
            [$validator, '42'],
            [$validator, '!@#$%^'],
        ];
    }

    /** @return iterable<array{Lowercase, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Lowercase();

        return [
            [$validator, 42],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, 'UPPERCASE'],
            [$validator, 'CamelCase'],
            [$validator, 'First Character Uppercase'],
            [$validator, 'With Numbers 1 2 3'],
        ];
    }
}
