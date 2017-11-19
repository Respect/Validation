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

class StartsWith extends AbstractRule
{
    public $startValue;
    public $identical;

    public function __construct($startValue, $identical = false)
    {
        $this->startValue = $startValue;
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
            return reset($input) == $this->startValue;
        }

        return 0 === mb_stripos($input, $this->startValue, 0, mb_detect_encoding($input));
    }

    protected function validateIdentical($input)
    {
        if (is_array($input)) {
            return reset($input) === $this->startValue;
        }

        return 0 === mb_strpos($input, $this->startValue, 0, mb_detect_encoding($input));
    }
}
