<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function function_exists;
use function is_string;
use function json_decode;
use function json_last_error;
use function json_validate;

use const JSON_ERROR_NONE;

#[Template(
    '{{name}} must be a valid JSON string',
    '{{name}} must not be a valid JSON string',
)]
final class Json extends Simple
{
    protected function isValid(mixed $input): bool
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
