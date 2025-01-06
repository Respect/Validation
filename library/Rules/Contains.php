<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function in_array;
use function is_array;
use function is_scalar;
use function mb_stripos;
use function mb_strpos;

/**
 * Validates if the input contains some value.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Marcelo Araujo <msaraujo@php.net>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Contains extends AbstractRule
{
    /**
     * @var mixed
     */
    private $containsValue;

    /**
     * @var bool
     */
    private $identical;

    /**
     * Initializes the Contains rule.
     *
     * @param mixed $containsValue Value that will be sought
     * @param bool $identical Defines whether the value is identical, default is false
     */
    public function __construct($containsValue, bool $identical = false)
    {
        $this->containsValue = $containsValue;
        $this->identical = $identical;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (is_array($input)) {
            return in_array($this->containsValue, $input, $this->identical);
        }

        if (!is_scalar($input) || !is_scalar($this->containsValue)) {
            return false;
        }

        return $this->validateString((string) $input, (string) $this->containsValue);
    }

    private function validateString(string $haystack, string $needle): bool
    {
        if ($needle === '') {
            return false;
        }

        if ($this->identical) {
            return mb_strpos($haystack, $needle) !== false;
        }

        return mb_stripos($haystack, $needle) !== false;
    }
}
