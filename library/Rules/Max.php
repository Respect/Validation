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

use function array_map;
use function max;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('The maximum of', 'The maximum of')]
final class Max extends FilteredNonEmptyArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $max = max($input);

        return $this->enrichResult($input, $this->rule->evaluate($max));
    }

    private function enrichResult(mixed $input, Result $result): Result
    {
        if (!$result->allowsSubsequent()) {
            return $result
                ->withInput($input)
                ->withChildren(
                    ...array_map(fn(Result $child) => $this->enrichResult($input, $child), $result->children)
                );
        }

        return (new Result($result->isValid, $input, $this, id: $result->id))
            ->withPrefixedId('max')
            ->withSubsequent($result->withInput($input));
    }
}
