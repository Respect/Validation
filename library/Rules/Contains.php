<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class Contains extends AbstractRule
{
    public $containsValue;
    public $identical;

    public function __construct($containsValue, $identical = false)
    {
        $this->containsValue = $containsValue;
        $this->identical = $identical;
    }

    protected function validateConcrete($input)
    {
        if ($this->identical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    protected function validateEquals($input)
    {
        if (is_array($input)) {
            return in_array($this->containsValue, $input);
        }

        return false !== mb_stripos($input, $this->containsValue, 0, mb_detect_encoding($input));
    }

    protected function validateIdentical($input)
    {
        if (is_array($input)) {
            return in_array($this->containsValue, $input, true);
        }

        return false !== mb_strpos($input, $this->containsValue, 0, mb_detect_encoding($input));
    }
}
