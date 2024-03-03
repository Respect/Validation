<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function filter_var;

use const FILTER_VALIDATE_INT;

#[Template(
    '{{name}} must be an even number',
    '{{name}} must not be an even number',
)]
final class Even extends Simple
{
    public function validate(mixed $input): bool
    {
        if (filter_var($input, FILTER_VALIDATE_INT) === false) {
            return false;
        }

        return (int) $input % 2 === 0;
    }
}
