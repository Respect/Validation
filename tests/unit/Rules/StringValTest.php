<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\ToStringStub;
use stdClass;

use function tmpfile;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\StringVal
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class StringValTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new StringVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
            [$rule, new ToStringStub('something')],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new StringVal();

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
