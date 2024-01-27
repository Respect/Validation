<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use stdClass;
use Traversable;

use function is_array;

trait CanValidateIterable
{
    public function isIterable(mixed $value): bool
    {
        return is_array($value) || $value instanceof stdClass || $value instanceof Traversable;
    }
}
