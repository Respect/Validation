<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MinChain
{
    /** @return Chain<mixed> */
    public function minBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function minBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function minEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minEven(): Chain;

    /** @return Chain<mixed> */
    public function minFactor(int $dividend): Chain;

    /** @return Chain<mixed> */
    public function minFinite(): Chain;

    /** @return Chain<mixed> */
    public function minGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function minInfinite(): Chain;

    /** @return Chain<mixed> */
    public function minLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function minMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function minOdd(): Chain;

    /** @return Chain<mixed> */
    public function minPositive(): Chain;
}
