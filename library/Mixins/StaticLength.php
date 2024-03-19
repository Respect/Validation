<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface StaticLength
{
    public static function lengthBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function lengthBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function lengthEquals(mixed $compareTo): ChainedValidator;

    public static function lengthEquivalent(mixed $compareTo): ChainedValidator;

    public static function lengthEven(): ChainedValidator;

    public static function lengthFactor(int $dividend): ChainedValidator;

    public static function lengthFibonacci(): ChainedValidator;

    public static function lengthFinite(): ChainedValidator;

    public static function lengthGreaterThan(mixed $compareTo): ChainedValidator;

    public static function lengthGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function lengthIdentical(mixed $compareTo): ChainedValidator;

    public static function lengthIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function lengthInfinite(): ChainedValidator;

    public static function lengthLessThan(mixed $compareTo): ChainedValidator;

    public static function lengthLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function lengthMultiple(int $multipleOf): ChainedValidator;

    public static function lengthOdd(): ChainedValidator;

    public static function lengthPerfectSquare(): ChainedValidator;

    public static function lengthPositive(): ChainedValidator;

    public static function lengthPrimeNumber(): ChainedValidator;
}
