<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface LengthChain
{
    public function lengthBetween(mixed $minValue, mixed $maxValue): Chain;

    public function lengthBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function lengthEquals(mixed $compareTo): Chain;

    public function lengthEquivalent(mixed $compareTo): Chain;

    public function lengthEven(): Chain;

    public function lengthFactor(int $dividend): Chain;

    public function lengthFibonacci(): Chain;

    public function lengthFinite(): Chain;

    public function lengthGreaterThan(mixed $compareTo): Chain;

    public function lengthGreaterThanOrEqual(mixed $compareTo): Chain;

    public function lengthIdentical(mixed $compareTo): Chain;

    public function lengthIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public function lengthInfinite(): Chain;

    public function lengthLessThan(mixed $compareTo): Chain;

    public function lengthLessThanOrEqual(mixed $compareTo): Chain;

    public function lengthMultiple(int $multipleOf): Chain;

    public function lengthOdd(): Chain;

    public function lengthPerfectSquare(): Chain;

    public function lengthPositive(): Chain;

    public function lengthPrimeNumber(): Chain;
}
