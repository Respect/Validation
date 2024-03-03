<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

#[Template(
    '{{name}} must be identical as {{compareTo}}',
    '{{name}} must not be identical as {{compareTo}}',
)]
final class Identical extends Standard
{
    public function __construct(
        private readonly mixed $compareTo
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return new Result($input === $this->compareTo, $input, $this, ['compareTo' => $this->compareTo]);
    }
}
