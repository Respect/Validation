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
use function mb_strpos;

/**
 * Validates if the input contains some value.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
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
        $this->containsValue = (string) $containsValue;
        $this->identical = $identical;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($this->identical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    private function validateEquals($input): bool
    {
        if (is_array($input)) {
            return in_array($this->containsValue, $input);
        }

        $inputString = (string) $input;

        return false !== mb_stripos($inputString, $this->containsValue, 0, mb_detect_encoding($inputString));
    }

    private function validateIdentical($input): bool
    {
        if (is_array($input)) {
            return in_array($this->containsValue, $input, true);
        }

        $inputString = (string) $input;

        return false !== mb_strpos($inputString, $this->containsValue, 0, mb_detect_encoding($inputString));
    }
}
