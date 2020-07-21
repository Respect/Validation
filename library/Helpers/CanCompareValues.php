<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

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

/**
 * Helps to deal with comparable values.
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
trait CanCompareValues
{
    /**
     * Tries to convert a value into something that can be compared with PHP operators.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    private function toComparable($value)
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
        } catch (Throwable $e) {
            return $value;
        }
    }

    /**
     * Returns whether the values can be compared or not.
     *
     * @param mixed $left
     * @param mixed $right
     */
    private function isAbleToCompareValues($left, $right): bool
    {
        return is_scalar($left) === is_scalar($right);
    }
}
