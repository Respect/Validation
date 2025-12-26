<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function is_string;
use function trim;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must not be empty',
    '{{subject}} must be empty',
)]
final class NotEmpty implements Rule
{
    public function evaluate(mixed $input): Result
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return Result::of(!empty($input), $input, $this);
    }
}
