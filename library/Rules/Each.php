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
use Respect\Validation\Rules\Core\FilteredNonEmptyArray;

use function array_reduce;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'Each item in {{name}} must be valid',
    'Each item in {{name}} must be invalid',
)]
final class Each extends FilteredNonEmptyArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $children = [];
        foreach ($input as $key => $value) {
            $children[] = $this->rule->evaluate($value)->withPath($key);
        }
        $hasPassed = array_reduce(
            $children,
            static fn ($carry, $childResult) => $carry && $childResult->hasPassed,
            true,
        );

        return (new Result($hasPassed, $input, $this))
            ->withChildren(...$children)
            ->withNameFrom($this->rule);
    }
}
