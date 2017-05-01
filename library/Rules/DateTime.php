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

use DateTimeInterface;

class DateTime extends AbstractRule
{
    public $format = null;

    public function __construct($format = null)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if ($input instanceof DateTimeInterface) {
            return true;
        }

        if (!is_scalar($input)) {
            return false;
        }

        $inputString = (string) $input;

        if (is_null($this->format)) {
            return false !== strtotime($inputString);
        }

        $exceptionalFormats = [
            'c' => 'Y-m-d\TH:i:sP',
            'r' => 'D, d M Y H:i:s O',
        ];

        if (in_array($this->format, array_keys($exceptionalFormats))) {
            $this->format = $exceptionalFormats[$this->format];
        }

        $info = date_parse_from_format($this->format, $inputString);

        return $info['error_count'] === 0 && $info['warning_count'] === 0;
    }
}
