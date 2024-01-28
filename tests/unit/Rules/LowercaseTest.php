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
#[CoversClass(Lowercase::class)]
final class LowercaseTest extends RuleTestCase
{
    /**
     * @return array<array{Lowercase, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Lowercase();

        return [
            [$rule, ''],
            [$rule, 'lowercase'],
            [$rule, 'lowercase-with-dashes'],
            [$rule, 'lowercase with spaces'],
            [$rule, 'lowercase with numbers 123'],
            [$rule, 'lowercase with specials characters like ã ç ê'],
            [$rule, 'with specials characters like # $ % & * +'],
            [$rule, 'τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός'],
            [$rule, '42'],
            [$rule, '!@#$%^'],
        ];
    }

    /**
     * @return array<array{Lowercase, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Lowercase();

        return [
            [$rule, 42],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, 'UPPERCASE'],
            [$rule, 'CamelCase'],
            [$rule, 'First Character Uppercase'],
            [$rule, 'With Numbers 1 2 3'],
        ];
    }
}
