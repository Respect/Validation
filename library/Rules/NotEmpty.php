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
use Respect\Validation\Rules\Core\Standard;

use function is_string;
use function trim;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must not be empty',
    '{{name}} must be empty',
)]
final class NotEmpty extends Standard
{
    public function evaluate(mixed $input): Result
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return new Result(!empty($input), $input, $this);
    }
}
