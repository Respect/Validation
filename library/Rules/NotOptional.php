<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;

final class NotOptional extends AbstractRule
{
    use CanValidateUndefined;

    public function validate(mixed $input): bool
    {
        return $this->isUndefined($input) === false;
    }
}
