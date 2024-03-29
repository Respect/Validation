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

use function in_array;
use function is_array;
use function is_scalar;
use function mb_stripos;
use function mb_strpos;

#[Template(
    '{{name}} must contain the value {{containsValue}}',
    '{{name}} must not contain the value {{containsValue}}',
)]
final class Contains extends Standard
{
    public function __construct(
        private readonly mixed $containsValue,
        private readonly bool $identical = false
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['containsValue' => $this->containsValue];
        if (is_array($input)) {
            return new Result(in_array($this->containsValue, $input, $this->identical), $input, $this, $parameters);
        }

        if (!is_scalar($input) || !is_scalar($this->containsValue)) {
            return Result::failed($input, $this, $parameters);
        }

        return new Result(
            $this->validateString((string) $input, (string) $this->containsValue),
            $input,
            $this,
            $parameters,
        );
    }

    private function validateString(string $haystack, string $needle): bool
    {
        if ($needle === '') {
            return false;
        }

        if ($this->identical) {
            return mb_strpos($haystack, $needle) !== false;
        }

        return mb_stripos($haystack, $needle) !== false;
    }
}
