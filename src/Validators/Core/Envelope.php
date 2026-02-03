<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Result;
use Respect\Validation\Validator;

abstract class Envelope implements Validator
{
    /** @param array<string, mixed> $parameters */
    public function __construct(
        private readonly Validator $validator,
        private readonly array $parameters = [],
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of($this->validator->evaluate($input)->hasPassed, $input, $this, $this->parameters);
    }
}
