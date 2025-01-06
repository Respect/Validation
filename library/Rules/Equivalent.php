<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;
use function mb_strtoupper;

/**
 * Validates if the input is equivalent to some value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Equivalent extends AbstractRule
{
    /**
     * @var mixed
     */
    private $compareTo;

    /**
     * Initializes the rule.
     *
     * @param mixed $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (is_scalar($input)) {
            return $this->isStringEquivalent((string) $input);
        }

        return $input == $this->compareTo;
    }

    private function isStringEquivalent(string $input): bool
    {
        if (!is_scalar($this->compareTo)) {
            return false;
        }

        return mb_strtoupper((string) $input) === mb_strtoupper((string) $this->compareTo);
    }
}
