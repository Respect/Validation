<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface LengthBuilder
{
    /** @return Chain<string|array|\Countable> */
    public static function lengthBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthEquals(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthEquivalent(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthEven(): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthFactor(int $dividend): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthFinite(): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthIdentical(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthIn(mixed $haystack): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthInfinite(): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthLessThan(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthMultiple(int $multipleOf): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthOdd(): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function lengthPositive(): Chain;
}
