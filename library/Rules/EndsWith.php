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

use function end;
use function is_array;
use function mb_strlen;
use function mb_strripos;
use function mb_strrpos;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must end with {{endValue}}',
    '{{subject}} must not end with {{endValue}}',
)]
final readonly class EndsWith implements Rule
{
    public function __construct(
        private mixed $endValue,
        private bool $identical = false,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['endValue' => $this->endValue];
        if ($this->identical) {
            return Result::of($this->validateIdentical($input), $input, $this, $parameters);
        }

        return Result::of($this->validateEquals($input), $input, $this, $parameters);
    }

    private function validateEquals(mixed $input): bool
    {
        if (is_array($input)) {
            return end($input) == $this->endValue;
        }

        return mb_strripos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }

    private function validateIdentical(mixed $input): bool
    {
        if (is_array($input)) {
            return end($input) === $this->endValue;
        }

        return mb_strrpos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }
}
