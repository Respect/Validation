<?php

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Countable;
use DateTimeImmutable;
use DateTimeInterface;
use Throwable;

use function is_numeric;
use function is_scalar;
use function is_string;
use function mb_strlen;

trait CanCompareValues
{
    private function toComparable(mixed $value): mixed
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

        try {
            return new DateTimeImmutable($value);
        } catch (Throwable) {
            return $value;
        }
    }

    private function isAbleToCompareValues(mixed $left, mixed $right): bool
    {
        return is_scalar($left) === is_scalar($right);
    }
}
