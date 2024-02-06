<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_string;
use function mb_strtolower;

#[Template(
    '{{name}} must be lowercase',
    '{{name}} must not be lowercase',
)]
final class Lowercase extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return $input === mb_strtolower($input);
    }
}
