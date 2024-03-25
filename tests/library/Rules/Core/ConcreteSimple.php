<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules\Core;

use Respect\Validation\Rules\Core\Simple;

final class ConcreteSimple extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return true;
    }
}
