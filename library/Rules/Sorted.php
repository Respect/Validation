<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function array_values;
use function count;
use function is_array;
use function is_string;
use function sprintf;
use function str_split;

final class Sorted extends AbstractRule
{
    public const ASCENDING = 'ASC';
    public const DESCENDING = 'DESC';

    public function __construct(private string $direction)
    {
        if ($direction !== self::ASCENDING && $direction !== self::DESCENDING) {
            throw new ComponentException(
                sprintf('Direction should be either "%s" or "%s"', self::ASCENDING, self::DESCENDING)
            );
        }
    }

    public function validate(mixed $input): bool
    {
        if (!is_array($input) && !is_string($input)) {
            return false;
        }

        $values = $this->getValues($input);
        $count = count($values);
        for ($position = 1; $position < $count; ++$position) {
            if (!$this->isSorted($values[$position], $values[$position - 1])) {
                return false;
            }
        }

        return true;
    }

    private function isSorted(mixed $current, mixed $last): bool
    {
        if ($this->direction === self::ASCENDING) {
            return $current > $last;
        }

        return $current < $last;
    }

    /**
     * @param string|mixed[] $input
     *
     * @return mixed[]
     */
    private function getValues(string|array $input): array
    {
        if (is_array($input)) {
            return array_values($input);
        }

        return str_split($input);
    }
}
