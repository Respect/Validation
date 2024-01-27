<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function function_exists;
use function is_string;
use function json_decode;
use function json_last_error;
use function json_validate;

use const JSON_ERROR_NONE;

final class Json extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input) || $input === '') {
            return false;
        }

        if (function_exists('json_validate')) {
            return json_validate($input);
        }

        json_decode($input);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
