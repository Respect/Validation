<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Marcelo Araujo <msaraujo@php.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function is_array;
use function is_string;
use function mb_strpos;
use function reset;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must start with {{startValue}}',
    '{{subject}} must not start with {{startValue}}',
)]
final readonly class StartsWith implements Validator
{
    public function __construct(
        private mixed $startValue,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['startValue' => $this->startValue];

        return Result::of($this->validateIdentical($input), $input, $this, $parameters);
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
