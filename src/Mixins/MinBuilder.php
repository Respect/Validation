<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MinBuilder
{
    /** @return Chain<iterable> */
    public static function minBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<iterable> */
    public static function minBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<iterable> */
    public static function minEquals(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minEquivalent(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minEven(): Chain;

    /** @return Chain<iterable> */
    public static function minFactor(int $dividend): Chain;

    /** @return Chain<iterable> */
    public static function minFinite(): Chain;

    /** @return Chain<iterable> */
    public static function minGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minIdentical(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minIn(mixed $haystack): Chain;

    /** @return Chain<iterable> */
    public static function minInfinite(): Chain;

    /** @return Chain<iterable> */
    public static function minLessThan(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function minMultiple(int $multipleOf): Chain;

    /** @return Chain<iterable> */
    public static function minOdd(): Chain;

    /** @return Chain<iterable> */
    public static function minPositive(): Chain;
}
