<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Lcobucci\Clock\SystemClock;
use Psr\Clock\ClockInterface;
use Respect\Validation\Helpers\CanCompareValues;
use Respect\Validation\Result;
use Respect\Validation\Validator;

abstract class Comparison implements Validator
{
    use CanCompareValues;

    private readonly ClockInterface $clock;

    public function __construct(
        private readonly mixed $compareTo,
        ClockInterface|null $clock = null,
    ) {
        $this->clock = $clock ?? SystemClock::fromSystemTimezone();
    }

    public function evaluate(mixed $input): Result
    {
        $left = $this->toComparable($input, $this->clock);
        $right = $this->toComparable($this->compareTo, $this->clock);

        $parameters = ['compareTo' => $this->compareTo];

        if (!$this->isAbleToCompareValues($left, $right)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->compare($left, $right), $input, $this, $parameters);
    }

    abstract protected function compare(mixed $left, mixed $right): bool;
}
