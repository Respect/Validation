<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

use function chr;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Printable
 */
final class PrintableTest extends RuleTestCase
{
    /**
     * @return array<array{Printable, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Printable();

        return [
            [$rule, ' '],
            [$rule, 'LKA#@%.54'],
            [$rule, 'foobar'],
            [$rule, '16-50'],
            [$rule, '123'],
            [$rule, 'foo bar'],
            [$rule, '#$%&*_'],
            [new Printable("\t\n"), "\t\n "],
            [new Printable("\v\r"), "\v\r "],
        ];
    }

    /**
     * @return array<array{Printable, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Printable();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 'foo' . chr(7) . 'bar'],
            [$rule, 'foo' . chr(10) . 'bar'],
        ];
    }
}
