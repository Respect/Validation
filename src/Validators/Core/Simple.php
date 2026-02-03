<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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
