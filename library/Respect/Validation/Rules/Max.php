<?php
namespace Respect\Validation\Rules;

class Max extends AbstractRule
{
    public $maxValue;
    public $inclusive;

    public function __construct($maxValue, $inclusive=false)
    {
        $this->maxValue = $maxValue;
        $this->inclusive = $inclusive;
    }

    public function validate($input)
    {
        if ($this->inclusive) {
            return $input <= $this->maxValue;
        } else {
            return $input < $this->maxValue;
        }
    }
}

