<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
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

use function in_array;
use function is_array;
use function mb_strpos;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be in {{haystack}}',
    '{{subject}} must not be in {{haystack}}',
)]
final readonly class In implements Validator
{
    public function __construct(
        private mixed $haystack,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['haystack' => $this->haystack];

        return Result::of($this->validate($input), $input, $this, $parameters);
    }

    private function validate(mixed $input): bool
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack, strict: true);
        }

        if ($input === null || $input === '') {
            return $input === $this->haystack;
        }

        return mb_strpos($this->haystack, (string) $input) !== false;
    }
}
