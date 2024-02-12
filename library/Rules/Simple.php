<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

abstract class Simple extends Standard
{
    public function evaluate(mixed $input): Result
    {
        return new Result($this->validate($input), $input, $this, self::TEMPLATE_STANDARD);
    }
}
