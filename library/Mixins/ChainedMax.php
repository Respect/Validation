<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface ChainedMax
{
    public function maxBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function maxBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function maxEquals(mixed $compareTo): ChainedValidator;

    public function maxEquivalent(mixed $compareTo): ChainedValidator;

    public function maxEven(): ChainedValidator;

    public function maxFactor(int $dividend): ChainedValidator;

    public function maxFibonacci(): ChainedValidator;

    public function maxFinite(): ChainedValidator;

    public function maxGreaterThan(mixed $compareTo): ChainedValidator;

    public function maxGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function maxIdentical(mixed $compareTo): ChainedValidator;

    public function maxIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function maxInfinite(): ChainedValidator;

    public function maxLessThan(mixed $compareTo): ChainedValidator;

    public function maxLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function maxMultiple(int $multipleOf): ChainedValidator;

    public function maxOdd(): ChainedValidator;

    public function maxPerfectSquare(): ChainedValidator;

    public function maxPositive(): ChainedValidator;

    public function maxPrimeNumber(): ChainedValidator;
}
