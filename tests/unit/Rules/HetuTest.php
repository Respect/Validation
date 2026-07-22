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
 * @covers \Respect\Validation\Rules\Hetu
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ville Hukkamäki <vhukkamaki@gmail.com>
 */
final class HetuTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Hetu();

        return [
            [$rule, '010106A9012'],
            [$rule, '290199-907A'],
            [$rule, '010199+9012'],
            [$rule, '280291+913L'],
            [$rule, '280291+923X'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Hetu();

        return [
            [$rule, '010106a9012'],
            [$rule, '010106_9012'],
            [$rule, '010106G9012'],
            [$rule, '010106Z9012'],
            [$rule, '010106A901G'],
            [$rule, '010106A901I'],
            [$rule, '010106A901O'],
            [$rule, '010106A901Q'],
            [$rule, '010106A901Z'],
            [$rule, '010106!9012'],
            [$rule, '010106'],
            [$rule, '01X199+9012'],
            [$rule, '999999A9999'],
            [$rule, '999999A999F'],
            [$rule, '300201A1236'],
            [$rule, '290201A123J'],
            [$rule, 123],
            [$rule, null],
            [$rule, new stdClass()],
        ];
    }
}
