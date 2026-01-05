<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators;

use Respect\Validation\Validators\Core\Simple;

final class CustomRule extends Simple
{
    public function isValid(mixed $input): bool
    {
        return false;
    }
}
