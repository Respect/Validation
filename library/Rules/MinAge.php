<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

final class MinAge extends AbstractAge
{
    protected function compare(int $baseDate, int $givenDate): bool
    {
        return $baseDate >= $givenDate;
    }
}
