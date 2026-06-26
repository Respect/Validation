<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

interface LengthChain
{
    /** @return Chain<mixed> */
    public function lengthBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function lengthBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function lengthEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthEven(): Chain;

    /** @return Chain<mixed> */
    public function lengthFactor(int $dividend): Chain;

    /** @return Chain<mixed> */
    public function lengthFinite(): Chain;

    /** @return Chain<mixed> */
    public function lengthGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function lengthInfinite(): Chain;

    /** @return Chain<mixed> */
    public function lengthLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function lengthMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function lengthOdd(): Chain;

    /** @return Chain<mixed> */
    public function lengthPositive(): Chain;
}
