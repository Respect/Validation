<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\DataProvider;

/**
 * Data provider to use when testing against undefined values.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
trait UndefinedProvider
{
    /**
     * Returns values that are considered as "undefined"
     *
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
     * Returns values that are not considered as "undefined"
     *
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
