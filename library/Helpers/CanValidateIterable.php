<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
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
