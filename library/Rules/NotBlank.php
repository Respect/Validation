<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use stdClass;

use function array_filter;
use function is_array;
use function is_numeric;
use function is_string;
use function trim;

final class NotBlank extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (is_numeric($input)) {
            return $input != 0;
        }

        if (is_string($input)) {
            $input = trim($input);
        }

        if ($input instanceof stdClass) {
            $input = (array) $input;
        }

        if (is_array($input)) {
            $input = array_filter($input, __METHOD__);
        }

        return !empty($input);
    }
}
