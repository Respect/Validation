<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_null;
use function is_scalar;
use function preg_match;

#[Template(
    '{{name}} must not contain whitespaces',
    '{{name}} must contain at least one whitespace',
)]
final class NoWhitespace extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (is_null($input)) {
            return true;
        }

        if (is_scalar($input) === false) {
            return false;
        }

        return !preg_match('#\s#', (string) $input);
    }
}
