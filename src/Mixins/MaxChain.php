<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MaxChain
{
    public function maxBetween(mixed $minValue, mixed $maxValue): Chain;

    public function maxBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function maxEquals(mixed $compareTo): Chain;

    public function maxEquivalent(mixed $compareTo): Chain;

    public function maxEven(): Chain;

    public function maxFactor(int $dividend): Chain;

    public function maxFibonacci(): Chain;

    public function maxFinite(): Chain;

    public function maxGreaterThan(mixed $compareTo): Chain;

    public function maxGreaterThanOrEqual(mixed $compareTo): Chain;

    public function maxIdentical(mixed $compareTo): Chain;

    public function maxIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public function maxInfinite(): Chain;

    public function maxLessThan(mixed $compareTo): Chain;

    public function maxLessThanOrEqual(mixed $compareTo): Chain;

    public function maxMultiple(int $multipleOf): Chain;

    public function maxOdd(): Chain;

    public function maxPerfectSquare(): Chain;

    public function maxPositive(): Chain;

    public function maxPrimeNumber(): Chain;
}
