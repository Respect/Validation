<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Result;

abstract class Simple extends Standard
{
    abstract public function isValid(mixed $input): bool;

    public function evaluate(mixed $input): Result
    {
        return new Result($this->isValid($input), $input, $this);
    }
}
