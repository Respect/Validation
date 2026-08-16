<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Countable;
use DateTimeInterface;
use Lcobucci\Clock\SystemClock;
use Psr\Clock\ClockInterface;

use function is_numeric;
use function is_scalar;
use function is_string;
use function mb_strlen;

trait CanCompareValues
{
    use CanResolveDateTime;

    private function toComparable(mixed $value, ClockInterface|null $clock = null): mixed
    {
        if ($value instanceof Countable) {
            return $value->count();
        }

        if ($value instanceof DateTimeInterface || !is_string($value) || is_numeric($value) || empty($value)) {
            return $value;
        }

        if (mb_strlen($value) === 1) {
            return $value;
        }

        return $this->resolveDateTime($value, $clock ?? SystemClock::fromSystemTimezone()) ?? $value;
    }

    private function isAbleToCompareValues(mixed $left, mixed $right): bool
    {
        return is_scalar($left) === is_scalar($right);
    }
}
