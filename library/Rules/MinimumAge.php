<?php
namespace Respect\Validation\Rules;

use DateTime;

class MinimumAge extends AbstractRule
{
    public $age = null;
    public $format = null;

    public function __construct($age, $format=null)
    {
        $this->age = $age;
        $this->format = $format;
    }

    public function validate($input)
    {
        if (!is_int($this->age)) {
            return false;
        }

        if ($input instanceof DateTime) {
            $birthday = new \DateTime('now - '.$this->age.' year');

            return $birthday > $input;
        } elseif (!is_string($input) || (is_null($this->format) && false === strtotime($input))) {
            return false;
        } else {
            $age = ((date('Ymd') - date('Ymd', strtotime($input))) / 10000);

            return $age >= $this->age;
        }
    }
}

