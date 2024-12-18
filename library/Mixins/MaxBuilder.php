<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MaxBuilder
{
    public static function maxBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function maxBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function maxEquals(mixed $compareTo): Chain;

    public static function maxEquivalent(mixed $compareTo): Chain;

    public static function maxEven(): Chain;

    public static function maxFactor(int $dividend): Chain;

    public static function maxFibonacci(): Chain;

    public static function maxFinite(): Chain;

    public static function maxGreaterThan(mixed $compareTo): Chain;

    public static function maxGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function maxIdentical(mixed $compareTo): Chain;

    public static function maxIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function maxInfinite(): Chain;

    public static function maxLessThan(mixed $compareTo): Chain;

    public static function maxLessThanOrEqual(mixed $compareTo): Chain;

    public static function maxMultiple(int $multipleOf): Chain;

    public static function maxOdd(): Chain;

    public static function maxPerfectSquare(): Chain;

    public static function maxPositive(): Chain;

    public static function maxPrimeNumber(): Chain;
}
