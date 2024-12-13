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
    '{{name}} must be identical to {{compareTo}}',
    '{{name}} must not be identical to {{compareTo}}',
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
