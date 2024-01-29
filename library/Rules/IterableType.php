<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;
use Respect\Validation\Helpers\CanValidateIterable;

#[Template(
    '{{name}} must be iterable',
    '{{name}} must not be iterable',
)]
final class IterableType extends AbstractRule
{
    use CanValidateIterable;

    public function validate(mixed $input): bool
    {
        return $this->isIterable($input);
    }
}
