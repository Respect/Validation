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

use DateTimeImmutable;
use DateTimeInterface;

class LeapDate extends AbstractRule
{
    public $format = null;

    public function __construct($format)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if (is_string($input)) {
            $date = DateTimeImmutable::createFromFormat($this->format, $input);
        } elseif ($input instanceof DateTimeInterface) {
            $date = $input;
        } else {
            return false;
        }

        // Dates that aren't leap will aways be rounded
        return $date->format('m-d') == '02-29';
    }
}
