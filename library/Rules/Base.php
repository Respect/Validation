<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function mb_strlen;
use function mb_substr;
use function preg_match;

#[Template(
    '{{name}} must be a number in the base {{base|raw}}',
    '{{name}} must not be a number in the base {{base|raw}}',
)]
final class Base extends Standard
{
    public function __construct(
        private readonly int $base,
        private readonly string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $max = mb_strlen($this->chars);
        if ($base > $max) {
            throw new InvalidRuleConstructorException('a base between 1 and %s is required', (string) $max);
        }
    }

    public function evaluate(mixed $input): Result
    {
        return new Result(
            (bool) preg_match('@^[' . mb_substr($this->chars, 0, $this->base) . ']+$@', (string) $input),
            $input,
            $this,
            ['base' => $this->base]
        );
    }
}
