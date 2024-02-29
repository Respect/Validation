<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Message\Template;

#[Template(
    '{{name}} must be iterable',
    '{{name}} must not be iterable',
)]
final class IterableVal extends Simple
{
    use CanValidateIterable;

    public function validate(mixed $input): bool
    {
        return $this->isIterable($input);
    }
}
