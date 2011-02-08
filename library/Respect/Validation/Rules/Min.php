<?php

namespace Respect\Validation\Rules;

class Min extends AbstractRule
{

    protected $inclusive;
    protected $min;

    public function __construct($minValue, $inclusive=false)
    {
        $this->min = $minValue;
        $this->inclusive = $inclusive;
    }

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->min,
            $this->inclusive);
    }

    public function validate($input)
    {
        if ($this->inclusive)
            return $input >= $this->min;
        else
            return $input > $this->min;
    }

}