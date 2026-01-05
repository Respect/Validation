<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Result;
use Respect\Validation\Validator;

abstract class Simple implements Validator
{
    abstract public function isValid(mixed $input): bool;

    public function evaluate(mixed $input): Result
    {
        return Result::of($this->isValid($input), $input, $this);
    }
}
