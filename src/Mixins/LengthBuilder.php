<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface LengthBuilder
{
    public static function lengthBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function lengthBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function lengthEquals(mixed $compareTo): Chain;

    public static function lengthEquivalent(mixed $compareTo): Chain;

    public static function lengthEven(): Chain;

    public static function lengthFactor(int $dividend): Chain;

    public static function lengthFibonacci(): Chain;

    public static function lengthFinite(): Chain;

    public static function lengthGreaterThan(mixed $compareTo): Chain;

    public static function lengthGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function lengthIdentical(mixed $compareTo): Chain;

    public static function lengthIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function lengthInfinite(): Chain;

    public static function lengthLessThan(mixed $compareTo): Chain;

    public static function lengthLessThanOrEqual(mixed $compareTo): Chain;

    public static function lengthMultiple(int $multipleOf): Chain;

    public static function lengthOdd(): Chain;

    public static function lengthPerfectSquare(): Chain;

    public static function lengthPositive(): Chain;

    public static function lengthPrimeNumber(): Chain;
}
