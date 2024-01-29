<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function is_null;
use function is_scalar;
use function preg_match;

#[Template(
    '{{name}} must not contain whitespace',
    '{{name}} must contain whitespace',
)]
final class NoWhitespace extends AbstractRule
{
    public function validate(mixed $input): bool
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
