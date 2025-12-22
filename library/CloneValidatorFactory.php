<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

final readonly class CloneValidatorFactory implements ValidatorFactory
{
    public function __construct(
        private Validator $validator,
    ) {
    }

    public function create(): Validator
    {
        return clone $this->validator;
    }
}
