<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Countable as CountableInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a countable value',
    '{{subject}} must not be a countable value',
)]
final class Countable extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_array($input) || $input instanceof CountableInterface;
    }
}
