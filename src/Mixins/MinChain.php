<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MinChain
{
    public function minBetween(mixed $minValue, mixed $maxValue): Chain;

    public function minBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function minEquals(mixed $compareTo): Chain;

    public function minEquivalent(mixed $compareTo): Chain;

    public function minEven(): Chain;

    public function minFactor(int $dividend): Chain;

    public function minFinite(): Chain;

    public function minGreaterThan(mixed $compareTo): Chain;

    public function minGreaterThanOrEqual(mixed $compareTo): Chain;

    public function minIdentical(mixed $compareTo): Chain;

    public function minIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public function minInfinite(): Chain;

    public function minLessThan(mixed $compareTo): Chain;

    public function minLessThanOrEqual(mixed $compareTo): Chain;

    public function minMultiple(int $multipleOf): Chain;

    public function minOdd(): Chain;

    public function minPositive(): Chain;
}
