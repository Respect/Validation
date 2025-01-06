<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;
use function preg_match;

/**
 * Validates whether the input matches a defined regular expression.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Regex extends AbstractRule
{
    /**
     * @var string
     */
    private $regex;

    /**
     * Initializes the rule.
     */
    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match($this->regex, (string) $input) > 0;
    }
}
