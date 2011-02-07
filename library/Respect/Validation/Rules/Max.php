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

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->reportError($input, array(), $this->max,
                $this->inclusive);
        return true;
    }

    public function validate($input)
    {
        if ($this->inclusive)
            return $input <= $this->max;
        else
            return $input < $this->max;
    }

}