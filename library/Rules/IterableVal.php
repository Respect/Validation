<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be an iterable value',
    '{{name}} must not be an iterable value',
)]
final class IterableVal extends Simple
{
    use CanValidateIterable;

    protected function isValid(mixed $input): bool
    {
        return $this->isIterable($input);
    }
}
