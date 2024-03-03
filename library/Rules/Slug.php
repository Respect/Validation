<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_string;
use function mb_strstr;
use function preg_match;

#[Template(
    '{{name}} must be a valid slug',
    '{{name}} must not be a valid slug',
)]
final class Slug extends Simple
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input) || mb_strstr($input, '--')) {
            return false;
        }

        if (!preg_match('@^[0-9a-z\-]+$@', $input)) {
            return false;
        }

        return preg_match('@^-|-$@', $input) === 0;
    }
}
