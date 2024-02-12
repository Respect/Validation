<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\Simple;

final class ConcreteSimple extends Simple
{
    public function validate(mixed $input): bool
    {
        return true;
    }
}
