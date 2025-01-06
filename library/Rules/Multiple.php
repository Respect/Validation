<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function filter_var;

use const FILTER_VALIDATE_INT;

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class Multiple extends AbstractRule
{
    /**
     * @var int
     */
    private $multipleOf;

    public function __construct(int $multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (filter_var($input, FILTER_VALIDATE_INT) === false) {
            return false;
        }
        if ($this->multipleOf == 0) {
            return $input == 0;
        }

        return $input % $this->multipleOf == 0;
    }
}
