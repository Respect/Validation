<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface StaticMin
{
    public static function minBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function minBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function minEquals(mixed $compareTo): ChainedValidator;

    public static function minEquivalent(mixed $compareTo): ChainedValidator;

    public static function minEven(): ChainedValidator;

    public static function minFactor(int $dividend): ChainedValidator;

    public static function minFibonacci(): ChainedValidator;

    public static function minFinite(): ChainedValidator;

    public static function minGreaterThan(mixed $compareTo): ChainedValidator;

    public static function minGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function minIdentical(mixed $compareTo): ChainedValidator;

    public static function minIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function minInfinite(): ChainedValidator;

    public static function minLessThan(mixed $compareTo): ChainedValidator;

    public static function minLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function minMultiple(int $multipleOf): ChainedValidator;

    public static function minOdd(): ChainedValidator;

    public static function minPerfectSquare(): ChainedValidator;

    public static function minPositive(): ChainedValidator;

    public static function minPrimeNumber(): ChainedValidator;
}
