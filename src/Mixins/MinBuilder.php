<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MinBuilder
{
    public static function minBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function minBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function minEquals(mixed $compareTo): Chain;

    public static function minEquivalent(mixed $compareTo): Chain;

    public static function minEven(): Chain;

    public static function minFactor(int $dividend): Chain;

    public static function minFinite(): Chain;

    public static function minGreaterThan(mixed $compareTo): Chain;

    public static function minGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function minIdentical(mixed $compareTo): Chain;

    public static function minIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function minInfinite(): Chain;

    public static function minLessThan(mixed $compareTo): Chain;

    public static function minLessThanOrEqual(mixed $compareTo): Chain;

    public static function minMultiple(int $multipleOf): Chain;

    public static function minOdd(): Chain;

    public static function minPositive(): Chain;
}
