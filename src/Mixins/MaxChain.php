<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface MaxChain
{
    /** @return Chain<mixed> */
    public function maxBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function maxBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function maxEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxEven(): Chain;

    /** @return Chain<mixed> */
    public function maxFactor(int $dividend): Chain;

    /** @return Chain<mixed> */
    public function maxFinite(): Chain;

    /** @return Chain<mixed> */
    public function maxGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function maxInfinite(): Chain;

    /** @return Chain<mixed> */
    public function maxLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function maxMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function maxOdd(): Chain;

    /** @return Chain<mixed> */
    public function maxPositive(): Chain;
}
