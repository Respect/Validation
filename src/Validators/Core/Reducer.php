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
use Respect\Validation\Validators\AllOf;

final readonly class Reducer implements Validator
{
    private Validator $validator;

    public function __construct(Validator $validator1, Validator ...$validators)
    {
        $this->validator = $validators === [] ? $validator1 : new AllOf($validator1, ...$validators);
    }

    public function evaluate(mixed $input): Result
    {
        return $this->validator->evaluate($input);
    }
}
