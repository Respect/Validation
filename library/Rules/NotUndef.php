<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be defined',
    '{{subject}} must be undefined',
)]
final class NotUndef implements Rule
{
    use CanValidateUndefined;

    public function evaluate(mixed $input): Result
    {
        return Result::of($this->isUndefined($input) === false, $input, $this);
    }
}
