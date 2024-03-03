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

use function is_scalar;
use function preg_match;

#[Template(
    '{{name}} must validate against `{{regex|raw}}`',
    '{{name}} must not validate against `{{regex|raw}}`',
)]
final class Regex extends Standard
{
    public function __construct(
        private readonly string $regex
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['regex' => $this->regex];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return new Result(preg_match($this->regex, (string) $input) === 1, $input, $this, $parameters);
    }
}
