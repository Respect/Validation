<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Result;
use Respect\Validation\Validators\IterableType;

use function is_array;
use function iterator_to_array;

abstract class FilteredArray extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        $iterableResult = (new IterableType())->evaluate($input);
        if (!$iterableResult->hasPassed) {
            return $iterableResult->withIdFrom($this);
        }

        $array = $this->toArray($input);

        if ($array === []) {
            return Result::passed($input, $this)->asIndeterminate();
        }

        return $this->evaluateArray($array);
    }

    /** @param array<mixed> $input */
    abstract protected function evaluateArray(array $input): Result;

    /**
     * @param iterable<mixed> $input
     *
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
