<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface ChainedMin
{
    public function minBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function minBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function minEquals(mixed $compareTo): ChainedValidator;

    public function minEquivalent(mixed $compareTo): ChainedValidator;

    public function minEven(): ChainedValidator;

    public function minFactor(int $dividend): ChainedValidator;

    public function minFibonacci(): ChainedValidator;

    public function minFinite(): ChainedValidator;

    public function minGreaterThan(mixed $compareTo): ChainedValidator;

    public function minGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function minIdentical(mixed $compareTo): ChainedValidator;

    public function minIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function minInfinite(): ChainedValidator;

    public function minLessThan(mixed $compareTo): ChainedValidator;

    public function minLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function minMultiple(int $multipleOf): ChainedValidator;

    public function minOdd(): ChainedValidator;

    public function minPerfectSquare(): ChainedValidator;

    public function minPositive(): ChainedValidator;

    public function minPrimeNumber(): ChainedValidator;
}
