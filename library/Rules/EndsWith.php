<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function end;
use function is_array;
use function mb_strlen;
use function mb_strripos;
use function mb_strrpos;

/**
 * Validates only if the value is at the end of the input.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class EndsWith extends AbstractRule
{
    /**
     * @var mixed
     */
    private $endValue;

    /**
     * @var bool
     */
    private $identical;

    /**
     * @param mixed $endValue
     */
    public function __construct($endValue, bool $identical = false)
    {
        $this->endValue = $endValue;
        $this->identical = $identical;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($this->identical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    /**
     * @param mixed $input
     */
    private function validateEquals($input): bool
    {
        if (is_array($input)) {
            return end($input) == $this->endValue;
        }

        return mb_strripos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }

    /**
     * @param mixed $input
     */
    private function validateIdentical($input): bool
    {
        if (is_array($input)) {
            return end($input) === $this->endValue;
        }

        return mb_strrpos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }
}
