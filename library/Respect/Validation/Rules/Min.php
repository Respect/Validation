<?php

namespace Respect\Validation\Rules;

class Min extends AbstractRule
{

    public $inclusive;
    public $minValue;

    public function __construct($minValue, $inclusive=false)
    {
        $this->minValue = $minValue;
        $this->inclusive = $inclusive;
    }

    public function validate($input)
    {
        if ($this->inclusive)
            return $input >= $this->minValue;
        else
            return $input > $this->minValue;
    }

}

