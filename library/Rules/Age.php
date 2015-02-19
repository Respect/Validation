<?php
namespace Respect\Validation\Rules;

use DateTime;

class Age extends AbstractRule
{
    private $maxAge = null;
    private $minAge = null;

    public function __construct($min, $max = null)
    {
        $this->minAge = $min;
        $this->maxAge = $max;
    }

    public function validate($input)
    {
        if (! is_int($this->minAge) || ! is_int($this->maxAge)) {
            return false;
        }

        if ($input instanceof DateTime) {
            return $this->dateTimeResolver();
        } 

        if (!is_string($input) || (is_null($this->format) && false === strtotime($input))) {
            return false;
        } 

        $age = ((date('Ymd') - date('Ymd', strtotime($input))) / 10000);

        if ($this->maxAge) {
            return $age >= $this->minAge and $age <= $this->maxAge;
        }

        return $age >= $this->minAge;
    }

    private function dateTimeResolver($input)
    {
        $birthday = new DateTime('now - '.$this->minAge.' year');

        if ($this->maxAge) {
            $limit = new DateTime('now + '.$this->maxAge. ' year');
            return $birthday > $input and $limit < $input;
        }

        return $birthday > $input;
    }
}
