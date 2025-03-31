<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Result;
use Respect\Validation\Rules\IterableType;
use Respect\Validation\Rules\NotEmpty;

use function is_array;
use function iterator_to_array;

abstract class FilteredNonEmptyArray extends Wrapper
{
    /** @param non-empty-array<mixed> $input */
    abstract protected function evaluateNonEmptyArray(array $input): Result;

    public function evaluate(mixed $input): Result
    {
        $iterableResult = (new IterableType())->evaluate($input);
        if (!$iterableResult->hasPassed) {
            return $iterableResult->withIdFrom($this)->withNameFrom($this->rule);
        }

        $array = $this->toArray($input);
        $notEmptyResult = (new NotEmpty())->evaluate($array);
        if (!$notEmptyResult->hasPassed) {
            return $notEmptyResult->withIdFrom($this)->withNameFrom($this->rule);
        }

        // @phpstan-ignore-next-line
        return $this->evaluateNonEmptyArray($array);
    }

    /**
     * @param iterable<mixed> $input
     * @return array<mixed>
     */
    private function toArray(iterable $input): array
    {
        if (is_array($input)) {
            return $input;
        }

        return iterator_to_array($input);
    }
}
