<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Result;
use Respect\Validation\Validator;

abstract class Wrapper implements Validator
{
    public function __construct(
        protected readonly Validator $validator,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return $this->validator->evaluate($input);
    }

    public function getValidator(): Validator
    {
        return $this->validator;
    }
}
