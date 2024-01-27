<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayAccess;
use SimpleXMLElement;

use function is_array;

final class ArrayVal extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_array($input) || $input instanceof ArrayAccess || $input instanceof SimpleXMLElement;
    }
}
