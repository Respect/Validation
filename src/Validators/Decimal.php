<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: toxxxa <toxxxa@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function is_numeric;
use function is_string;
use function number_format;
use function preg_replace;
use function var_export;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must have {{decimals}} decimal places',
    '{{subject}} must not have {{decimals}} decimal places',
)]
final readonly class Decimal implements Validator
{
    public function __construct(
        private int $decimals,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['decimals' => $this->decimals];
        if (!is_numeric($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->isValidDecimal($input), $input, $this, $parameters);
    }

    private function isValidDecimal(mixed $input): bool
    {
        return $this->toFormattedString($input) === $this->toRawString($input);
    }

    private function toRawString(mixed $input): string
    {
        if (is_string($input)) {
            return $input;
        }

        return var_export($input, true);
    }

    private function toFormattedString(mixed $input): string
    {
        $formatted = number_format((float) $input, $this->decimals, '.', '');
        if (is_string($input)) {
            return $formatted;
        }

        return preg_replace('/^(\d+\.\d)0*$/', '$1', $formatted) ?: '';
    }
}
