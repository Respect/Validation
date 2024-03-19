<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface ChainedLength
{
    public function lengthBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function lengthBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function lengthEquals(mixed $compareTo): ChainedValidator;

    public function lengthEquivalent(mixed $compareTo): ChainedValidator;

    public function lengthEven(): ChainedValidator;

    public function lengthFactor(int $dividend): ChainedValidator;

    public function lengthFibonacci(): ChainedValidator;

    public function lengthFinite(): ChainedValidator;

    public function lengthGreaterThan(mixed $compareTo): ChainedValidator;

    public function lengthGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function lengthIdentical(mixed $compareTo): ChainedValidator;

    public function lengthIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function lengthInfinite(): ChainedValidator;

    public function lengthLessThan(mixed $compareTo): ChainedValidator;

    public function lengthLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function lengthMultiple(int $multipleOf): ChainedValidator;

    public function lengthOdd(): ChainedValidator;

    public function lengthPerfectSquare(): ChainedValidator;

    public function lengthPositive(): ChainedValidator;

    public function lengthPrimeNumber(): ChainedValidator;
}
