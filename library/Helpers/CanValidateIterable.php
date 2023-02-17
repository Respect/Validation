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

/**
 * Helper to handle iterable values.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
trait CanValidateIterable
{
    /**
     * Returns whether the value is iterable or not.
     *
     * @param mixed $value
     */
    public function isIterable($value): bool
    {
        return is_array($value) || $value instanceof stdClass || $value instanceof Traversable;
    }
}
