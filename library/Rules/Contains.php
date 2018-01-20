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

class Contains extends AbstractRule
{
    public $containsValue;
    public $identical;

    public function __construct($containsValue, $identical = false)
    {
        $this->containsValue = (string) $containsValue;
        $this->identical = $identical;
    }

    public function validate($input)
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

        $inputString = (string) $input;

        return false !== mb_stripos($inputString, $this->containsValue, 0, mb_detect_encoding($inputString));
    }

    protected function validateIdentical($input)
    {
        if (is_array($input)) {
            return in_array($this->containsValue, $input, true);
        }

        $inputString = (string) $input;

        return false !== mb_strpos($inputString, $this->containsValue, 0, mb_detect_encoding($inputString));
    }
}
