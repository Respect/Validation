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
use Respect\Validation\Validators\Circuit;
use Respect\Validation\Validators\GreaterThan;
use Respect\Validation\Validators\IterableType;
use Respect\Validation\Validators\Length;
use Respect\Validation\Validators\Not;
use Respect\Validation\Validators\Undef;

use function is_array;
use function iterator_to_array;

abstract class FilteredNonEmptyArray extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        $iterableResult = (new IterableType())->evaluate($input);
        if (!$iterableResult->hasPassed) {
            return $iterableResult->withIdFrom($this);
        }

        $array = $this->toArray($input);
        $validator = new Circuit(
            new Not(new Undef()),
            new Length(new GreaterThan(0)),
        );
        $result = $validator->evaluate($array);
        if (!$result->hasPassed) {
            return $result->withIdFrom($this);
        }

        // @phpstan-ignore-next-line
        return $this->evaluateNonEmptyArray($array);
    }

    /** @param non-empty-array<mixed> $input */
    abstract protected function evaluateNonEmptyArray(array $input): Result;

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
