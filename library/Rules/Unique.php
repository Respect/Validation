<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function array_unique;
use function is_array;

use const SORT_REGULAR;

#[Template(
    '{{name}} must not contain duplicates',
    '{{name}} must contain duplicates',
)]
final class Unique extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return $input == array_unique($input, SORT_REGULAR);
    }
}
