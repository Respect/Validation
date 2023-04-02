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
 * @covers \Respect\Validation\Rules\Regex
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class RegexTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Regex('/^[a-z]+$/'), 'wpoiur'],
            [new Regex('/^[a-z]+$/i'), 'wPoiur'],
            [new Regex('/^[0-9]+$/i'), 42],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Regex('/^w+$/'), 'w poiur'],
            [new Regex('/^w+$/'), new stdClass()],
            [new Regex('/^w+$/'), []],
        ];
    }
}
