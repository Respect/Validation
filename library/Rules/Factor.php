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

use function abs;
use function is_int;
use function is_numeric;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a factor of {{dividend|raw}}',
    '{{subject}} must not be a factor of {{dividend|raw}}',
)]
final readonly class Factor implements Rule
{
    public function __construct(
        private int $dividend,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['dividend' => $this->dividend];
        // Every integer is a factor of zero, and zero is the only integer that
        // has zero for a factor.
        if ($this->dividend === 0) {
            return Result::passed($input, $this, $parameters);
        }

        // Factors must be integers that are not zero.
        if (!is_numeric($input) || preg_match('/^-?\d+$/', (string) $input) === 0 || $input == 0) {
            return Result::failed($input, $this, $parameters);
        }

        $input = (int) abs((int) $input);
        $dividend = (int) abs($this->dividend);

        // The dividend divided by the input must be an integer if input is a
        // factor of the dividend.
        return Result::of(is_int($dividend / $input), $input, $this, $parameters);
    }
}
