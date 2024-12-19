<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\FilteredNonEmptyArray;

use function array_map;

abstract class ArrayAggregateFunction extends FilteredNonEmptyArray
{
    protected string $idPrefix;
    
    /**
     * This function should extract the aggregate data from the input array
     * 
     * @param non-empty-array<mixed> $input
     */
    abstract protected function extractAggregate(array $input): mixed;

    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $aggregate = $this->extractAggregate($input);

        return $this->enrichResult($input, $this->rule->evaluate($aggregate));
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
            ->withPrefixedId($this->idPrefix)
            ->withSubsequent($result->withInput($input));
    }
}