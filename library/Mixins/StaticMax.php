<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface StaticMax
{
    public static function maxBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function maxBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function maxEquals(mixed $compareTo): ChainedValidator;

    public static function maxEquivalent(mixed $compareTo): ChainedValidator;

    public static function maxEven(): ChainedValidator;

    public static function maxFactor(int $dividend): ChainedValidator;

    public static function maxFibonacci(): ChainedValidator;

    public static function maxFinite(): ChainedValidator;

    public static function maxGreaterThan(mixed $compareTo): ChainedValidator;

    public static function maxGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function maxIdentical(mixed $compareTo): ChainedValidator;

    public static function maxIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function maxInfinite(): ChainedValidator;

    public static function maxLessThan(mixed $compareTo): ChainedValidator;

    public static function maxLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function maxMultiple(int $multipleOf): ChainedValidator;

    public static function maxOdd(): ChainedValidator;

    public static function maxPerfectSquare(): ChainedValidator;

    public static function maxPositive(): ChainedValidator;

    public static function maxPrimeNumber(): ChainedValidator;
}
