<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Result;
use Respect\Validation\Rules\IterableType;
use Respect\Validation\Rules\NotEmpty;

use function is_array;
use function iterator_to_array;
use function lcfirst;
use function strrchr;
use function substr;

abstract class FilteredNonEmptyArray extends Wrapper
{
    use CanBindEvaluateRule;

    /** @param non-empty-array<mixed> $input */
    abstract protected function evaluateNonEmptyArray(array $input): Result;

    public function evaluate(mixed $input): Result
    {
        $id = $this->rule->getName() ?? $this->getName() ?? lcfirst(substr((string) strrchr(static::class, '\\'), 1));
        $iterableResult = $this->bindEvaluate(new IterableType(), $this, $input);
        if (!$iterableResult->isValid) {
            return $iterableResult->withId($id);
        }

        $array = $this->toArray($input);
        $notEmptyResult = $this->bindEvaluate(new NotEmpty(), $this, $array);
        if (!$notEmptyResult->isValid) {
            return $notEmptyResult->withId($id);
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
