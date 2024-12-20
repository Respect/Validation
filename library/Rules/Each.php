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
            $children[] = $this->rule->evaluate($value)->withUnchangeableId((string) $key);
        }
        $isValid = array_reduce($children, static fn ($carry, $childResult) => $carry && $childResult->isValid, true);
        if ($isValid) {
            return Result::passed($input, $this)->withChildren(...$children);
        }

        return Result::failed($input, $this)->withChildren(...$children);
    }
}
