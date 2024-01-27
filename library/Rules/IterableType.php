<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateIterable;

final class IterableType extends AbstractRule
{
    use CanValidateIterable;

    public function validate(mixed $input): bool
    {
        return $this->isIterable($input);
    }
}
