<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MaxBuilder
{
    /** @return Chain<iterable> */
    public static function maxBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<iterable> */
    public static function maxBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<iterable> */
    public static function maxEquals(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxEquivalent(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxEven(): Chain;

    /** @return Chain<iterable> */
    public static function maxFactor(int $dividend): Chain;

    /** @return Chain<iterable> */
    public static function maxFinite(): Chain;

    /** @return Chain<iterable> */
    public static function maxGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxIdentical(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxIn(mixed $haystack): Chain;

    /** @return Chain<iterable> */
    public static function maxInfinite(): Chain;

    /** @return Chain<iterable> */
    public static function maxLessThan(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function maxMultiple(int $multipleOf): Chain;

    /** @return Chain<iterable> */
    public static function maxOdd(): Chain;

    /** @return Chain<iterable> */
    public static function maxPositive(): Chain;
}
