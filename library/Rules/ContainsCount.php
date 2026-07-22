<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_reduce;
use function is_array;
use function is_scalar;
use function mb_substr_count;

/**
 * Validates if the input contains a value a certain number of times.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ContainsCount extends AbstractRule
{
    /**
     * @var mixed
     */
    private $containsValue;

    /**
     * @var int
     */
    private $count;

    /**
     * Initializes the ContainsCount rule.
     *
     * @param mixed $containsValue Value that will be sought
     * @param int $count Number of times the value must appear
     */
    public function __construct($containsValue, int $count)
    {
        $this->containsValue = $containsValue;
        $this->count = $count;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (is_array($input)) {
            return $this->countArrayOccurrences($input) === $this->count;
        }

        if (!is_scalar($input) || !is_scalar($this->containsValue)) {
            return false;
        }

        $needle = (string) $this->containsValue;
        if ($needle === '') {
            return false;
        }

        return mb_substr_count((string) $input, $needle) === $this->count;
    }

    /**
     * @param mixed[] $input
     */
    private function countArrayOccurrences(array $input): int
    {
        return array_reduce(
            $input,
            function (int $carry, $item): int {
                return $carry + ($item === $this->containsValue ? 1 : 0);
            },
            0
        );
    }
}
