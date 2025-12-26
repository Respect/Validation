<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function mb_strlen;
use function mb_substr;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a number in base {{base|raw}}',
    '{{subject}} must not be a number in base {{base|raw}}',
)]
final readonly class Base implements Rule
{
    public function __construct(
        private int $base,
        private string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ) {
        $max = mb_strlen($this->chars);
        if ($base > $max) {
            throw new InvalidRuleConstructorException('a base between 1 and %s is required', (string) $max);
        }
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of(
            (bool) preg_match('@^[' . mb_substr($this->chars, 0, $this->base) . ']+$@', (string) $input),
            $input,
            $this,
            ['base' => $this->base],
        );
    }
}
