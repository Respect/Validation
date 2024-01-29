<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function is_string;
use function mb_strlen;
use function preg_match;

#[Template(
    '{{name}} must be Base64-encoded',
    '{{name}} must not be Base64-encoded',
)]
final class Base64 extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (!preg_match('#^[A-Za-z0-9+/\n\r]+={0,2}$#', $input)) {
            return false;
        }

        return mb_strlen($input) % 4 === 0;
    }
}
