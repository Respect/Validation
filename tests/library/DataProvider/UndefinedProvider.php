<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\DataProvider;

trait UndefinedProvider
{
    /**
     * @return mixed[][]
     */
    public static function providerForUndefined(): array
    {
        return [
            [null],
            [''],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerForNotUndefined(): array
    {
        return [
            [0],
            [0.0],
            ['0'],
            [false],
            [true],
            [' '],
            [[]],
        ];
    }
}
