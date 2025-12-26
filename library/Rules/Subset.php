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

use function array_diff;
use function is_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be subset of {{superset}}',
    '{{subject}} must not be subset of {{superset}}',
)]
final readonly class Subset implements Rule
{
    /** @param mixed[] $superset */
    public function __construct(
        private array $superset,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['superset' => $this->superset];
        if (!is_array($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of(array_diff($input, $this->superset) === [], $input, $this, $parameters);
    }
}
