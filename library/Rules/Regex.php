<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_scalar;
use function preg_match;

#[Template(
    '{{name}} must validate against `{{regex|raw}}`',
    '{{name}} must not validate against `{{regex|raw}}`',
)]
final class Regex extends AbstractRule
{
    public function __construct(
        private readonly string $regex
    ) {
    }

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match($this->regex, (string) $input) > 0;
    }

    /**
     * @return array<string, string>
     */
    public function getParams(): array
    {
        return ['regex' => $this->regex];
    }
}
