<?php

namespace Respect\Validation\Rules;

class Max extends AbstractRule
{

    protected $inclusive;
    protected $max;

    public function __construct($maxValue, $inclusive=false)
    {
        $this->max = $maxValue;
        $this->inclusive = $inclusive;
    }

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->max,
            $this->inclusive);
    }

    public function validate($input)
    {
        if ($this->inclusive)
            return $input <= $this->max;
        else
            return $input < $this->max;
    }

}