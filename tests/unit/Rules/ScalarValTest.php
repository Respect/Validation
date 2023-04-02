<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function tmpfile;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\ScalarVal
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ScalarValTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new ScalarVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new ScalarVal();

        return [
            [$rule, []],
            [
                $rule,
                static function (): void {
                },
            ],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, tmpfile()],
        ];
    }
}
