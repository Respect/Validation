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

use function is_array;
use function is_string;
use function mb_stripos;
use function mb_strpos;
use function reset;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must start with {{startValue}}',
    '{{subject}} must not start with {{startValue}}',
)]
final readonly class StartsWith implements Rule
{
    public function __construct(
        private mixed $startValue,
        private bool $identical = false,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['startValue' => $this->startValue];
        if ($this->identical) {
            return Result::of($this->validateIdentical($input), $input, $this, $parameters);
        }

        return Result::of($this->validateEquals($input), $input, $this, $parameters);
    }

    protected function validateEquals(mixed $input): bool
    {
        if (is_array($input)) {
            return reset($input) == $this->startValue;
        }

        if (is_string($input) && is_string($this->startValue)) {
            return mb_stripos($input, $this->startValue) === 0;
        }

        return false;
    }

    protected function validateIdentical(mixed $input): bool
    {
        if (is_array($input)) {
            return reset($input) === $this->startValue;
        }

        if (is_string($input) && is_string($this->startValue)) {
            return mb_strpos($input, $this->startValue) === 0;
        }

        return false;
    }
}
