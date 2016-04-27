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

use DateTime;

class Date extends AbstractRule
{
    public $format = null;

    public function __construct($format = null)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if ($input instanceof DateTime) {
            return true;
        } elseif (!is_string($input)) {
            return false;
        } elseif (is_null($this->format)) {
            return false !== strtotime($input);
        }

        $exceptionalFormats = [
            'c' => 'Y-m-d\TH:i:sP',
            'r' => 'D, d M Y H:i:s O',
            'm' => '!m',
            'n' => '!n',
            'F' => '!F',
            'M' => '!M'
        ];

        if (in_array($this->format, array_keys($exceptionalFormats))) {
            $this->format = $exceptionalFormats[ $this->format ];
        }

        $info = date_parse_from_format($this->format, $input);

        return ($info['error_count'] === 0 && $info['warning_count'] === 0);
    }
}
