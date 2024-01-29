<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function in_array;
use function is_array;
use function mb_stripos;
use function mb_strpos;

#[Template(
    '{{name}} must be in {{haystack}}',
    '{{name}} must not be in {{haystack}}',
)]
final class In extends AbstractRule
{
    public function __construct(
        private readonly mixed $haystack,
        private readonly bool $compareIdentical = false
    ) {
    }

    public function validate(mixed $input): bool
    {
        if ($this->compareIdentical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['haystack' => $this->haystack];
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
