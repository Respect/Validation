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
use Respect\Validation\Rule;

use function is_scalar;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must match the pattern {{regex|quote}}',
    '{{subject}} must not match the pattern {{regex|quote}}',
)]
final readonly class Regex implements Rule
{
    public function __construct(
        private string $regex,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['regex' => $this->regex];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of(preg_match($this->regex, (string) $input) === 1, $input, $this, $parameters);
    }
}
