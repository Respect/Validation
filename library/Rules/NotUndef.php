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
use Respect\Validation\Rules\Core\Standard;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be defined',
    '{{name}} must be undefined',
)]
final class NotUndef extends Standard
{
    use CanValidateUndefined;

    public function evaluate(mixed $input): Result
    {
        return new Result($this->isUndefined($input) === false, $input, $this);
    }
}
