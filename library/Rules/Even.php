<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function filter_var;

use const FILTER_VALIDATE_INT;

final class Even extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (filter_var($input, FILTER_VALIDATE_INT) === false) {
            return false;
        }

        return (int) $input % 2 === 0;
    }
}
