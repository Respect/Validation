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

class MinimumAge extends AbstractRule
{
    public $age = null;
    public $format = null;

    public function __construct($age, $format = null)
    {
        $this->age = $age;
        $this->format = $format;
    }

    public function validate($input)
    {
        if (!filter_var($this->age, FILTER_VALIDATE_INT)) {
            return false;
        }

        if ($input instanceof DateTime) {
            $birthday = new \DateTime('now - '.$this->age.' year');

            return $birthday > $input;
        }

        if (!is_string($input) || (is_null($this->format) && false === strtotime($input))) {
            return false;
        }

        $age = ((date('Ymd') - date('Ymd', strtotime($input))) / 10000);

        return $age >= $this->age;
    }
}
