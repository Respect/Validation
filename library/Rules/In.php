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

use function in_array;
use function is_array;
use function mb_stripos;
use function mb_strpos;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be in {{haystack}}',
    '{{subject}} must not be in {{haystack}}',
)]
final readonly class In implements Rule
{
    public function __construct(
        private mixed $haystack,
        private bool $compareIdentical = false,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['haystack' => $this->haystack];
        if ($this->compareIdentical) {
            return Result::of($this->validateIdentical($input), $input, $this, $parameters);
        }

        return Result::of($this->validateEquals($input), $input, $this, $parameters);
    }

    private function validateEquals(mixed $input): bool
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack);
        }

        if ($input === null || $input === '') {
            return $input == $this->haystack;
        }

        return mb_stripos($this->haystack, (string) $input) !== false;
    }

    private function validateIdentical(mixed $input): bool
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack, true);
        }

        if ($input === null || $input === '') {
            return $input === $this->haystack;
        }

        return mb_strpos($this->haystack, (string) $input) !== false;
    }
}
