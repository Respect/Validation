<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function in_array;
use function is_array;
use function mb_detect_encoding;
use function mb_stripos;

/**
 * Validates if the input contains at least one of provided values.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Kirill Dlussky <kirill@dlussky.ru>
 */
final class ContainsAny extends AbstractRule
{
    /**
     * @var array
     */
    private $needles;

    /**
     * @var bool
     */
    private $strictCompareArray;

    /**
     * Initializes the ContainsAny rule.
     *
     * @param array $needles At least one of the values provided must be found in input string or array
     * @param bool $strictCompareArray Defines whether the value should be compared strictly, when validating array
     */
    public function __construct(array $needles, bool $strictCompareArray = false)
    {
        $this->needles = $needles;
        $this->strictCompareArray = $strictCompareArray;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (is_array($input)) {
            return $this->validateArray($input);
        }

        return $this->validateString((string) $input);
    }

    private function validateString(string $inputString): bool
    {
        foreach ($this->needles as &$needle) {
            if (false !== mb_stripos($inputString, (string) $needle, 0, mb_detect_encoding($inputString))) {
                return true;
            }
        } unset ($needle);

        return false;
    }

    private function validateArray(array $inputArray): bool
    {
        foreach ($this->needles as &$needle) {
            if (in_array($needle, $inputArray, $this->strictCompareArray)) {
                return true;
            }
        } unset ($needle);

        return false;
    }
}
