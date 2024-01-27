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
 * @covers \Respect\Validation\Rules\Nip
 */
final class NipTest extends RuleTestCase
{
    /**
     * @return array<array{Nip, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Nip();

        return [
            [$rule, '1645865777'],
            [$rule, '5581418257'],
            [$rule, '1298727531'],
        ];
    }

    /**
     * @return array<array{Nip, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Nip();

        return [
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, '1645865778'],
            [$rule, '164-586-57-77'],
            [$rule, '164-58-65-777'],
            [$rule, '5581418258'],
            [$rule, '1298727532'],
            [$rule, '1234567890'],
        ];
    }
}
