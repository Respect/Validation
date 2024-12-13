<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a multiple of {{multipleOf}}',
    '{{name}} must not be a multiple of {{multipleOf}}',
)]
final class Multiple extends Standard
{
    public function __construct(
        private readonly int $multipleOf
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['multipleOf' => $this->multipleOf];
        if ($this->multipleOf == 0) {
            return new Result($input == 0, $input, $this, $parameters);
        }

        return new Result($input % $this->multipleOf == 0, $input, $this, $parameters);
    }
}
