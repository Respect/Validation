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

use function end;
use function is_array;
use function mb_strlen;
use function mb_strripos;
use function mb_strrpos;

#[Template(
    '{{name}} must end with {{endValue}}',
    '{{name}} must not end with {{endValue}}',
)]
final class EndsWith extends Standard
{
    public function __construct(
        private readonly mixed $endValue,
        private readonly bool $identical = false
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['endValue' => $this->endValue];
        if ($this->identical) {
            return new Result($this->validateIdentical($input), $input, $this, $parameters);
        }

        return new Result($this->validateEquals($input), $input, $this, $parameters);
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
