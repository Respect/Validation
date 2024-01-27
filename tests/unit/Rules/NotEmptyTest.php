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
 * @covers \Respect\Validation\Rules\NotEmpty
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NotEmptyTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new NotEmpty();

        return [
            [$rule, 1],
            [$rule, ' oi'],
            [$rule, [5]],
            [$rule, [0]],
            [$rule, new stdClass()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new NotEmpty();

        return [
            [$rule, ''],
            [$rule, '    '],
            [$rule, "\n"],
            [$rule, false],
            [$rule, null],
            [$rule, []],
        ];
    }
}
